<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoices;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(Invoices::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Invoices::create($data);
        return response()->json($item, 201);
    }

    public function show($invoices)
    {
        $item = Invoices::findOrFail($invoices);
        return response()->json($item);
    }

    public function update(Request $request, $invoices)
    {
        $item = Invoices::findOrFail($invoices);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($invoices)
    {
        $item = Invoices::findOrFail($invoices);
        $item->delete();
        return response()->json(null, 204);
    }
}
