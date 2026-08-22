<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
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
            'content' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'conversation_id' => $conversation->id,
            'user_id' => $request->user()->IdUser,
            'content' => $validated['content'],
        ]);

        broadcast(new MessageSent($message->load('user')))->toOthers();

        return response()->json($message->load('user'));
    }

private function authorizeParticipant(Request $request, Conversation $conversation): void
{
    abort_unless(
        $conversation->users()->where('Users.IdUser', $request->user()->IdUser)->exists(),
        403,
        'Vous ne faites pas partie de cette conversation.'
    );
}
}