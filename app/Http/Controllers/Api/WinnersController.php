<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Winners;
use Illuminate\Http\Request;

class WinnersController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(Winners::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Winners::create($data);
        return response()->json($item, 201);
    }

    public function show($winners)
    {
        $item = Winners::findOrFail($winners);
        return response()->json($item);
    }

    public function update(Request $request, $winners)
    {
        $item = Winners::findOrFail($winners);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($winners)
    {
        $item = Winners::findOrFail($winners);
        $item->delete();
        return response()->json(null, 204);
    }
}
