<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Events\MessageSent;
use App\Models\Conversation;
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

    return $message->load('user'); // sans restriction de colonnes pour l'instant
}
}