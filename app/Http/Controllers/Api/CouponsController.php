<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            Coupons::class,
            ['Title', 'Description', 'NumberOfCoupon'],
            ['Used', 'Active'],
            ['DateStart', 'DateEnd', 'Price', 'CreatedAt']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Coupons::create($data);
        return response()->json($item, 201);
    }

    public function show($coupons)
    {
        $item = Coupons::findOrFail($coupons);
        return response()->json($item);
    }

    public function update(Request $request, $coupons)
    {
        $item = Coupons::findOrFail($coupons);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($coupons)
    {
        $item = Coupons::findOrFail($coupons);
        $item->delete();
        return response()->json(null, 204);
    }
}
