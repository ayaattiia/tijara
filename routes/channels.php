<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Message;

Broadcast::channel('conversation.{conversationId}', function ($user, $conversationId) {
    return $user->conversations()->where('conversations.id', $conversationId)->exists();
});

Broadcast::channel('user.{userId}', function ($user, $userId) {
    return (int) $user->IdUser === (int) $userId;
});

Broadcast::channel('chat.{room}', function ($user, $room) {
    return $user ? ['id' => $user->IdUser, 'name' => $user->FirstName] : false;
});