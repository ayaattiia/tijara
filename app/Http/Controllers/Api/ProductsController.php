<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            Products::class,
            ['CodeBarProduct', 'CodeProduct', 'ReferenceProduct', 'TitleProduct', 'DescriptionProduct'],
            ['ColorProduct', 'TvaProduct', 'IdPricesDelevery', 'ImageProduct', 'VideoProduct', 'IdPrize', 'IdCateorie', 'IdUser', 'IdCountrie', 'Active'],
            ['QuantityProduct', 'PriceProduct']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Products::create($data);
        return response()->json($item, 201);
    }

    public function show($products)
    {
        $item = Products::findOrFail($products);
        return response()->json($item);
    }

    public function update(Request $request, $products)
    {
        $item = Products::findOrFail($products);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($products)
    {
        $item = Products::findOrFail($products);
        $item->delete();
        return response()->json(null, 204);
    }
}
