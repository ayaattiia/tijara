<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(OrderDetails::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = OrderDetails::create($data);
        return response()->json($item, 201);
    }

    public function show($order_details)
    {
        $item = OrderDetails::findOrFail($order_details);
        return response()->json($item);
    }

    public function update(Request $request, $order_details)
    {
        $item = OrderDetails::findOrFail($order_details);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($order_details)
    {
        $item = OrderDetails::findOrFail($order_details);
        $item->delete();
        return response()->json(null, 204);
    }
}
