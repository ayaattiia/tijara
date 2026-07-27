<?php

use App\Models\Chats;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{idChat}', function ($user, $idChat) {
    $chat = Chats::find($idChat);

    if (!$chat) {
        return false;
    }

    return (int) $chat->IdUserSender === (int) $user->IdUser
        || (int) $chat->IdUserReciver === (int) $user->IdUser;
});