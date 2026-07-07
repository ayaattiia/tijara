<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            Brands::class,
            ['Title', 'Description'],
            ['Image', 'Active'],
            []
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Brands::create($data);
        return response()->json($item, 201);
    }

    public function show($brands)
    {
        $item = Brands::findOrFail($brands);
        return response()->json($item);
    }

    public function update(Request $request, $brands)
    {
        $item = Brands::findOrFail($brands);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($brands)
    {
        $item = Brands::findOrFail($brands);
        $item->delete();
        return response()->json(null, 204);
    }
}
