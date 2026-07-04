<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Features;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(Features::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Features::create($data);
        return response()->json($item, 201);
    }

    public function show($features)
    {
        $item = Features::findOrFail($features);
        return response()->json($item);
    }

    public function update(Request $request, $features)
    {
        $item = Features::findOrFail($features);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($features)
    {
        $item = Features::findOrFail($features);
        $item->delete();
        return response()->json(null, 204);
    }
}
