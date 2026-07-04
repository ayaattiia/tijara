<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(Categories::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Categories::create($data);
        return response()->json($item, 201);
    }

    public function show($categories)
    {
        $item = Categories::findOrFail($categories);
        return response()->json($item);
    }

    public function update(Request $request, $categories)
    {
        $item = Categories::findOrFail($categories);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($categories)
    {
        $item = Categories::findOrFail($categories);
        $item->delete();
        return response()->json(null, 204);
    }
}
