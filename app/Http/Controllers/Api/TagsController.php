<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(Tags::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Tags::create($data);
        return response()->json($item, 201);
    }

    public function show($tags)
    {
        $item = Tags::findOrFail($tags);
        return response()->json($item);
    }

    public function update(Request $request, $tags)
    {
        $item = Tags::findOrFail($tags);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($tags)
    {
        $item = Tags::findOrFail($tags);
        $item->delete();
        return response()->json(null, 204);
    }
}
