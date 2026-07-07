<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TypeCategory;
use Illuminate\Http\Request;

class TypeCategoryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            TypeCategory::class,
            ['Title'],
            [],
            []
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = TypeCategory::create($data);
        return response()->json($item, 201);
    }

    public function show($type_category)
    {
        $item = TypeCategory::findOrFail($type_category);
        return response()->json($item);
    }

    public function update(Request $request, $type_category)
    {
        $item = TypeCategory::findOrFail($type_category);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($type_category)
    {
        $item = TypeCategory::findOrFail($type_category);
        $item->delete();
        return response()->json(null, 204);
    }
}
