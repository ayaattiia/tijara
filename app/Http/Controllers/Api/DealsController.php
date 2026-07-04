<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deals;
use Illuminate\Http\Request;

class DealsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(Deals::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Deals::create($data);
        return response()->json($item, 201);
    }

    public function show($deals)
    {
        $item = Deals::findOrFail($deals);
        return response()->json($item);
    }

    public function update(Request $request, $deals)
    {
        $item = Deals::findOrFail($deals);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($deals)
    {
        $item = Deals::findOrFail($deals);
        $item->delete();
        return response()->json(null, 204);
    }
}
