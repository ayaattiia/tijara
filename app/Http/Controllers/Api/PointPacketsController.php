<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PointPackets;
use Illuminate\Http\Request;

class PointPacketsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(PointPackets::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = PointPackets::create($data);
        return response()->json($item, 201);
    }

    public function show($point_packets)
    {
        $item = PointPackets::findOrFail($point_packets);
        return response()->json($item);
    }

    public function update(Request $request, $point_packets)
    {
        $item = PointPackets::findOrFail($point_packets);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($point_packets)
    {
        $item = PointPackets::findOrFail($point_packets);
        $item->delete();
        return response()->json(null, 204);
    }
}
