<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chats;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            Chats::class,
            [],
            ['IdUserSender', 'IdUserReciver', 'AdminReview', 'Active'],
            ['CreatedAt']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Chats::create($data);
        return response()->json($item, 201);
    }

    public function show($chats)
    {
        $item = Chats::findOrFail($chats);
        return response()->json($item);
    }

    public function update(Request $request, $chats)
    {
        $item = Chats::findOrFail($chats);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($chats)
    {
        $item = Chats::findOrFail($chats);
        $item->delete();
        return response()->json(null, 204);
    }
}
