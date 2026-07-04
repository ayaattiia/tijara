<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(Reviews::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Reviews::create($data);
        return response()->json($item, 201);
    }

    public function show($reviews)
    {
        $item = Reviews::findOrFail($reviews);
        return response()->json($item);
    }

    public function update(Request $request, $reviews)
    {
        $item = Reviews::findOrFail($reviews);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($reviews)
    {
        $item = Reviews::findOrFail($reviews);
        $item->delete();
        return response()->json(null, 204);
    }
}
