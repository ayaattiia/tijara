<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Events\NotificationSent;
use App\Http\Controllers\Controller;
use App\Models\Notifications;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index(Request $request)
    {
        $conversations = $request->user()
            ->conversations()
            ->with(['latestMessage.user'])
            ->get();

        return response()->json($conversations);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'exists:Users,IdUser',
            'name' => 'nullable|string|max:255',
        ]);

        $conversation = Conversation::create([
            'name' => $validated['name'] ?? null,
        ]);

        $participantIds = array_unique([
            ...$validated['user_ids'],
            $request->user()->IdUser,
        ]);

        $conversation->users()->attach($participantIds);

        return response()->json($conversation->load('users'), 201);
    }

    public function messages(Request $request, Conversation $conversation)
    {
        $this->authorizeParticipant($request, $conversation);

        return response()->json(
            $conversation->messages()->with('user')->latest()->take(50)->get()->reverse()->values()
        );
    }
    public function sendMessage(Request $request, Conversation $conversation)
    {
        $this->authorizeParticipant($request, $conversation);

        $validated = $request->validate([
            'content' => 'nullable|string|max:1000',
            'attachment' => 'nullable|file|max:10240',
        ]);

        if (empty($validated['content']) && !$request->hasFile('attachment')) {
            return response()->json([
                'message' => 'Le message doit contenir un texte ou une pièce jointe.'
            ], 422);
        }

        // 1. Créer le message
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'user_id' => $request->user()->IdUser,
            'content' => $validated['content'] ?? '',
        ]);

        // 2. Enregistrer la pièce jointe si présente
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');

            // IMPORTANT: capturer taille/type AVANT le move() - une fois
            // déplacé, le fichier temporaire d'origine n'existe plus et
            // getSize()/stat() plantent avec "stat failed for ...tmp".
            $fileSize = $file->getSize();
            $mimeType = $file->getClientMimeType();
            $originalClientName = $file->getClientOriginalName();

            $destination = public_path(config('media.paths.chats'));
            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }

            $originalName = pathinfo($originalClientName, PATHINFO_FILENAME);
            $safeName = \Illuminate\Support\Str::slug($originalName);
            $filename = $safeName . '-' . \Illuminate\Support\Str::random(8) . '.' . $file->getClientOriginalExtension();

            $file->move($destination, $filename);

            \App\Models\ChatMessageAttachments::create([
                'IdChatMessage' => $message->id,
                'OriginalName'  => $originalClientName,
                'FileName'      => $filename,
                'FilePath'      => config('media.paths.chats') . '/' . $filename,
                'MimeType'      => $mimeType,
                'FileSize'      => $fileSize,
                'CreatedAt'     => now(),
                'Active'        => 1,
            ]);
        }

        $message->load('user', 'attachments');

        // 3. Envoyer le message en temps réel
        broadcast(new MessageSent($message))->toOthers();

        // 4. Notifier chaque autre participant (distinct() protège contre
        // d'éventuelles lignes dupliquées dans conversation_user)
        $senderId = $request->user()->IdUser;

        $recipientIds = $conversation->users()
            ->where('Users.IdUser', '!=', $senderId)
            ->pluck('Users.IdUser')
            ->unique()
            ->values();

        $hasAttachment = $message->attachments->isNotEmpty();
        $description = match (true) {
            !empty($message->content) && $hasAttachment => $message->content . ' (+ pièce jointe)',
            $hasAttachment => 'Pièce jointe envoyée',
            default => $message->content,
        };

        foreach ($recipientIds as $recipientId) {
            $notification = Notifications::create([
                'IdUser' => $recipientId,
                'Title' => 'Nouveau message',
                'Description' => $description,
                'Type' => 'message',
                'Date' => now(),
                'IsRead' => false,
            ]);

            broadcast(new NotificationSent($notification))->toOthers();
        }

        return response()->json($message);
    }
    private function authorizeParticipant(Request $request, Conversation $conversation): void
    {
        abort_unless(
            $conversation->users()->where('Users.IdUser', $request->user()->IdUser)->exists(),
            403,
            'Vous ne faites pas partie de cette conversation.'
        );
    }

    /**
     * DELETE /api/conversations/{conversation}/messages/{message}
     * Seul l'auteur du message peut le supprimer. Supprime aussi les
     * fichiers physiques de ses pièces jointes. AUCUNE notification n'est
     * envoyée - une suppression est silencieuse par design.
     */
    public function destroyMessage(Request $request, Conversation $conversation, Message $message)
    {
        $this->authorizeParticipant($request, $conversation);

        abort_unless(
            $message->conversation_id === $conversation->id,
            404,
            'Ce message n\'appartient pas à cette conversation.'
        );

        abort_unless(
            (int) $message->user_id === (int) $request->user()->IdUser,
            403,
            'Vous ne pouvez supprimer que vos propres messages.'
        );

        foreach ($message->attachments as $attachment) {
            $path = public_path($attachment->FilePath);
            if (file_exists($path)) {
                unlink($path);
            }
            $attachment->delete();
        }

        $message->delete();

        return response()->json(['message' => 'Message supprimé.']);
    }
}
