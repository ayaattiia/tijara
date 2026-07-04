<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Likes;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(Likes::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Likes::create($data);
        return response()->json($item, 201);
    }

    public function show($likes)
    {
        $item = Likes::findOrFail($likes);
        return response()->json($item);
    }

    public function update(Request $request, $likes)
    {
        $item = Likes::findOrFail($likes);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($likes)
    {
        $item = Likes::findOrFail($likes);
        $item->delete();
        return response()->json(null, 204);
    }
}
