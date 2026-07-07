<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatMessages;
use Illuminate\Http\Request;

class ChatMessagesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            ChatMessages::class,
            ['Message'],
            ['IdChatMessage', 'IdChat', 'IdUserSender', 'Report', 'AdminReview', 'Active'],
            ['CreateDate']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = ChatMessages::create($data);
        return response()->json($item, 201);
    }

    public function show($chat_messages)
    {
        $item = ChatMessages::findOrFail($chat_messages);
        return response()->json($item);
    }

    public function update(Request $request, $chat_messages)
    {
        $item = ChatMessages::findOrFail($chat_messages);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($chat_messages)
    {
        $item = ChatMessages::findOrFail($chat_messages);
        $item->delete();
        return response()->json(null, 204);
    }
}
