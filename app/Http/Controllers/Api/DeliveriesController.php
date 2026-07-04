<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deliveries;
use Illuminate\Http\Request;

class DeliveriesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(Deliveries::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Deliveries::create($data);
        return response()->json($item, 201);
    }

    public function show($deliveries)
    {
        $item = Deliveries::findOrFail($deliveries);
        return response()->json($item);
    }

    public function update(Request $request, $deliveries)
    {
        $item = Deliveries::findOrFail($deliveries);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($deliveries)
    {
        $item = Deliveries::findOrFail($deliveries);
        $item->delete();
        return response()->json(null, 204);
    }
}
