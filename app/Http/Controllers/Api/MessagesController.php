<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            Messages::class,
            ['Message'],
            ['IdUserSender', 'IdUserReceiver', 'IdMessageReplay', 'Active'],
            ['DateMessage']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Messages::create($data);
        return response()->json($item, 201);
    }

    public function show($messages)
    {
        $item = Messages::findOrFail($messages);
        return response()->json($item);
    }

    public function update(Request $request, $messages)
    {
        $item = Messages::findOrFail($messages);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($messages)
    {
        $item = Messages::findOrFail($messages);
        $item->delete();
        return response()->json(null, 204);
    }
}
