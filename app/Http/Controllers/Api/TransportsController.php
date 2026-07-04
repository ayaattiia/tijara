<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transports;
use Illuminate\Http\Request;

class TransportsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(Transports::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Transports::create($data);
        return response()->json($item, 201);
    }

    public function show($transports)
    {
        $item = Transports::findOrFail($transports);
        return response()->json($item);
    }

    public function update(Request $request, $transports)
    {
        $item = Transports::findOrFail($transports);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($transports)
    {
        $item = Transports::findOrFail($transports);
        $item->delete();
        return response()->json(null, 204);
    }
}
