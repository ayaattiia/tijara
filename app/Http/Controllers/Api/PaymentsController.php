<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            Payments::class,
            ['Reference'],
            ['IdUser', 'IdOrder', 'Method', 'Status', 'TransactionId'],
            ['Amount', 'CreatedAt', 'PaidAt']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Payments::create($data);
        return response()->json($item, 201);
    }

    public function show($payments)
    {
        $item = Payments::findOrFail($payments);
        return response()->json($item);
    }

    public function update(Request $request, $payments)
    {
        $item = Payments::findOrFail($payments);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($payments)
    {
        $item = Payments::findOrFail($payments);
        $item->delete();
        return response()->json(null, 204);
    }
}
