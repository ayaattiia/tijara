<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function index(string $room = 'general')
    {
        $messages = Message::with('user')
            ->where('room', $room)
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->values();

        return view('chat.index', compact('messages', 'room'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'content' => 'required|string|max:1000',
        'room' => 'required|string',
    ]);

    $message = Message::create([
        'user_id' => $request->user()->IdUser,
        'room' => $validated['room'],
        'content' => $validated['content'],
    ]);

    broadcast(new MessageSent($message->load('user')))->toOthers();

    return response()->json($message->load('user'));
}
}