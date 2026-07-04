<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\States;
use Illuminate\Http\Request;

class StatesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(States::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = States::create($data);
        return response()->json($item, 201);
    }

    public function show($states)
    {
        $item = States::findOrFail($states);
        return response()->json($item);
    }

    public function update(Request $request, $states)
    {
        $item = States::findOrFail($states);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($states)
    {
        $item = States::findOrFail($states);
        $item->delete();
        return response()->json(null, 204);
    }
}
