<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ratings;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            Ratings::class,
            [],
            ['IdUser', 'TableName', 'IdTable', 'Active'],
            ['Rating', 'CommentRating', 'Date']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Ratings::create($data);
        return response()->json($item, 201);
    }

    public function show($ratings)
    {
        $item = Ratings::findOrFail($ratings);
        return response()->json($item);
    }

    public function update(Request $request, $ratings)
    {
        $item = Ratings::findOrFail($ratings);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($ratings)
    {
        $item = Ratings::findOrFail($ratings);
        $item->delete();
        return response()->json(null, 204);
    }
}
