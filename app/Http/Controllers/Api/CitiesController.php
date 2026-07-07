<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            Cities::class,
            ['Title', 'TitleEn', 'TitleAr'],
            ['IdCountry', 'Image', 'Active'],
            ['CreatedAt']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Cities::create($data);
        return response()->json($item, 201);
    }

    public function show($cities)
    {
        $item = Cities::findOrFail($cities);
        return response()->json($item);
    }

    public function update(Request $request, $cities)
    {
        $item = Cities::findOrFail($cities);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($cities)
    {
        $item = Cities::findOrFail($cities);
        $item->delete();
        return response()->json(null, 204);
    }
}
