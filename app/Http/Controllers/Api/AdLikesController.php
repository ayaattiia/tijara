<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdLikes;
use Illuminate\Http\Request;

class AdLikesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(AdLikes::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = AdLikes::create($data);
        return response()->json($item, 201);
    }

    public function show($ad_likes)
    {
        $item = AdLikes::findOrFail($ad_likes);
        return response()->json($item);
    }

    public function update(Request $request, $ad_likes)
    {
        $item = AdLikes::findOrFail($ad_likes);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($ad_likes)
    {
        $item = AdLikes::findOrFail($ad_likes);
        $item->delete();
        return response()->json(null, 204);
    }
}
