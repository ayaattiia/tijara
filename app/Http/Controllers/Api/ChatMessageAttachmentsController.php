<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatMessageAttachments;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ChatMessageAttachmentsController extends Controller
{
    /**
     * Vérifie que l'utilisateur appartient à la conversation.
     */
    private function authorizeAttachment(
        Request $request,
        ChatMessageAttachments $attachment
    ): void {

        $message = $attachment->message;

        abort_unless(
            $message,
            404,
            'Message introuvable.'
        );

        $conversation = Conversation::findOrFail(
            $message->conversation_id
        );

        $userId = $request->user()->IdUser;

        $isParticipant = $conversation
            ->users()
            ->where('Users.IdUser', $userId)
            ->exists();

        abort_unless(
            $isParticipant,
            403,
            'Accès non autorisé.'
        );
    }

    /**
     * GET /api/chat-attachments/{id}
     */
    public function show(Request $request, $id)
    {
        $attachment = ChatMessageAttachments::with('message')
            ->findOrFail($id);

        $this->authorizeAttachment(
            $request,
            $attachment
        );

        return response()->json([
            'IdAttachment' => $attachment->IdAttachment,
            'IdChatMessage' => $attachment->IdChatMessage,
            'OriginalName' => $attachment->OriginalName,
            'FileName' => $attachment->FileName,
            'FilePath' => asset($attachment->FilePath),
            'MimeType' => $attachment->MimeType,
            'FileSize' => $attachment->FileSize,
            'CreatedAt' => $attachment->CreatedAt,
            'Active' => $attachment->Active,
        ]);
    }

    /**
     * GET /api/chat-attachments/{id}/download
     */
    public function download(Request $request, $id)
    {
        $attachment = ChatMessageAttachments::with('message')
            ->findOrFail($id);

        $this->authorizeAttachment(
            $request,
            $attachment
        );

        $path = public_path(
            $attachment->FilePath
        );

        if (!file_exists($path)) {
            return response()->json([
                'message' => 'Fichier introuvable.'
            ], 404);
        }

        return response()->download(
            $path,
            $attachment->OriginalName
        );
    }

    /**
     * DELETE /api/chat-attachments/{id}
     */
    public function destroy(Request $request, $id)
    {
        $attachment = ChatMessageAttachments::with('message')
            ->findOrFail($id);

        $this->authorizeAttachment(
            $request,
            $attachment
        );

        $path = public_path(
            $attachment->FilePath
        );

        if (file_exists($path)) {
            unlink($path);
        }

        $attachment->delete();

        return response()->json([
            'message' => 'Pièce jointe supprimée.'
        ]);
    }
}
