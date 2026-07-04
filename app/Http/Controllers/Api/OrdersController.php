<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(Orders::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Orders::create($data);
        return response()->json($item, 201);
    }

    public function show($orders)
    {
        $item = Orders::findOrFail($orders);
        return response()->json($item);
    }

    public function update(Request $request, $orders)
    {
        $item = Orders::findOrFail($orders);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($orders)
    {
        $item = Orders::findOrFail($orders);
        $item->delete();
        return response()->json(null, 204);
    }
}
