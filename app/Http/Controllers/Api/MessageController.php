<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Events\MessageSent;
use App\Events\MessageNotification;
use App\Models\Conversation;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function store(Request $request, Conversation $conversation)
    {
        $authId = auth('api')->id();

        if (! $conversation->users->contains('IdUser', $authId)) {
            abort(403);
        }

        $request->validate([
            'body' => 'nullable|string|max:2000',
            'attachment' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,xlsx,zip', // 10 Mo max
        ]);

        // Il faut au moins un texte OU une pièce jointe
        if (! $request->filled('body') && ! $request->hasFile('attachment')) {
            return response()->json([
                'message' => 'Le message doit contenir du texte ou une pièce jointe.',
            ], 422);
        }

        $attachmentPath = null;
        $attachmentType = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $attachmentPath = $file->store('messages', 'public');

            $attachmentType = str_starts_with($file->getMimeType(), 'image/')
                ? 'image'
                : 'file';
        }

        $message = $conversation->messages()->create([
            'user_id' => $authId,
            'body' => $request->body,
            'attachment_path' => $attachmentPath,
            'attachment_type' => $attachmentType,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        $sender = auth('api')->user();

        // Notifier chaque autre participant de la conversation
        $recipients = $conversation->users->where('IdUser', '!=', $authId);

        foreach ($recipients as $recipient) {
            $description = $attachmentType === 'image'
                ? $sender->name . ' vous a envoyé une photo'
                : ($attachmentType === 'file'
                    ? $sender->name . ' vous a envoyé un fichier'
                    : $sender->name . ' vous a envoyé : ' . str($message->body)->limit(100));

            Notifications::create([
                'Title' => 'Nouveau message',
                'Description' => $description,
                'Date' => now()->toDateString(),
                'Type' => 'message',
                'IsRead' => 0,
                'IdUser' => $recipient->IdUser,
            ]);

            broadcast(new MessageNotification($message, $recipient->IdUser));
        }

        return $message->load('user');
    }
}