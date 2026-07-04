<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeaturesValues;
use Illuminate\Http\Request;

class FeaturesValuesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(FeaturesValues::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = FeaturesValues::create($data);
        return response()->json($item, 201);
    }

    public function show($features_values)
    {
        $item = FeaturesValues::findOrFail($features_values);
        return response()->json($item);
    }

    public function update(Request $request, $features_values)
    {
        $item = FeaturesValues::findOrFail($features_values);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($features_values)
    {
        $item = FeaturesValues::findOrFail($features_values);
        $item->delete();
        return response()->json(null, 204);
    }
}
