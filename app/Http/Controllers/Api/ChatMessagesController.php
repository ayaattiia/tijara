<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\ChatMessages;
use App\Models\Chats;
use Illuminate\Http\Request;

class ChatMessagesController extends Controller
{
    // Centralize the default/min/max so you can tweak them in one place
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    /**
     * GET /api/chats/{idChat}/messages
     */
    public function index(Request $request, $idChat)
    {
        $chat = Chats::findOrFail($idChat);
        $this->authorizeChatAccess($request, $chat);

        $perPage = $this->resolvePerPage($request);

        $query = $this->buildFilteredQuery(
            $request,
            ChatMessages::class,
            ['Message'],
            ['IdUserSender', 'Active'],
            ['CreateDate']
        )->where('IdChat', $idChat)->orderBy('CreateDate');

        return response()->json($query->paginate($perPage));
    }

    /**
     * POST /api/chats/{idChat}/messages   { "Message": "Bonjour !" }
     */
    public function store(Request $request, $idChat)
    {
        $chat = Chats::findOrFail($idChat);
        $this->authorizeChatAccess($request, $chat);

        $request->validate([
            'Message' => 'required|string|max:2000',
        ]);

        $item = ChatMessages::create([
            'IdChat'       => $idChat,
            'Message'      => $request->input('Message'),
            'CreateDate'   => now(),
            'IdUserSender' => $request->user()->IdUser,
            'Active'       => 1,
        ]);

        broadcast(new MessageSent($item))->toOthers();

        return response()->json($item, 201);
    }

    public function show(Request $request, $chat_messages)
    {
        $item = ChatMessages::findOrFail($chat_messages);
        $chat = Chats::findOrFail($item->IdChat);
        $this->authorizeChatAccess($request, $chat);

        return response()->json($item);
    }

    public function destroy(Request $request, $chat_messages)
    {
        $item = ChatMessages::findOrFail($chat_messages);
        $chat = Chats::findOrFail($item->IdChat);
        $this->authorizeChatAccess($request, $chat);

        $item->delete();
        return response()->json(null, 204);
    }

    private function authorizeChatAccess(Request $request, Chats $chat): void
    {
        $me = $request->user()->IdUser;

        if ((int) $chat->IdUserSender !== (int) $me && (int) $chat->IdUserReciver !== (int) $me) {
            abort(403, 'Acces non autorise a cette conversation.');
        }
    }

    private function resolvePerPage(Request $request): int
    {
        $perPage = (int) $request->query('per_page', self::DEFAULT_PER_PAGE);
        return max(self::MIN_PER_PAGE, min($perPage, self::MAX_PER_PAGE));
    }
}