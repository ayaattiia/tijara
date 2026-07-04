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
        return response()->json(Chats::paginate($perPage));
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
