<?php

// use App\Models\Chats;
use Illuminate\Support\Facades\Broadcast;

    Broadcast::channel('conversation.{conversationId}', function ($user, $conversationId) {
        return $user->conversations()->where('conversations.id', $conversationId)->exists();
    });
    Broadcast::channel('user.{userId}', function ($user, $userId) {
        return (int) $user->IdUser === (int) $userId;
    });