<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::with(['user:IdUser,Username,FirstName,LastName,Email,ProfilePicture'])
            ->paginate(10);

        return response()->json($products);
    }
    public function search($search)
    {
        $products = Products::with(['user:IdUser,Username,FirstName,LastName,Email,ProfilePicture'])
            ->where(function ($q) use ($search) {
                $q->where('TitleProduct', 'like', "%{$search}%")
                    ->orWhere('DescriptionProduct', 'like', "%{$search}%")
                    ->orWhere('ReferenceProduct', 'like', "%{$search}%")
                    ->orWhere('CodeBarProduct', 'like', "%{$search}%");
            })
            ->paginate(10);

        return response()->json($products);
    }

    public function byCategory($IdCateorie)
    {
        $products = Products::where('IdCateorie', $IdCateorie)->paginate(10);
        return response()->json($products);
    }

    public function byUser($IdUser)
    {
        $products = Products::where('IdUser', $IdUser)->paginate(10);
        return response()->json($products);
    }

    public function byPriceRange($min_price, $max_price)
    {
        $products = Products::whereBetween('PriceProduct', [$min_price, $max_price])->paginate(10);
        return response()->json($products);
    }

    public function byActive($Active)
    {
        $products = Products::where('Active', $Active)->paginate(10);
        return response()->json($products);
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
