<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Events\MessageSent;
use App\Events\MessageNotification;
use App\Models\Conversation;
use App\Models\Notifications;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request, Conversation $conversation)
    {
        $authId = auth('api')->id();

        if (! $conversation->users->contains('IdUser', $authId)) {
            abort(403);
        }

        $request->validate(['body' => 'required|string|max:2000']);

        $message = $conversation->messages()->create([
            'user_id' => $authId,
            'body' => $request->body,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        $sender = auth('api')->user();

        // Notifier chaque autre participant de la conversation
        $recipients = $conversation->users->where('IdUser', '!=', $authId);

        foreach ($recipients as $recipient) {
            // 1. Persister en base
            Notifications::create([
                'Title' => 'Nouveau message',
                'Description' => $sender->name . ' vous a envoyé : ' . str($message->body)->limit(100),
                'Date' => now()->toDateString(),
                'Type' => 'message',
                'IsRead' => 0,
                'IdUser' => $recipient->IdUser,
            ]);

            // 2. Diffuser en temps réel
            broadcast(new MessageNotification($message, $recipient->IdUser));
        }

        return $message->load('user');
    }
}