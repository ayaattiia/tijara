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

        $query = Products::with(['user:IdUser,Username,FirstName,LastName,Email,ProfilePicture']);

        // ---- Search (by title, description, reference, barcode) ----
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('TitleProduct', 'like', "%{$search}%")
                    ->orWhere('DescriptionProduct', 'like', "%{$search}%")
                    ->orWhere('ReferenceProduct', 'like', "%{$search}%")
                    ->orWhere('CodeBarProduct', 'like', "%{$search}%");
            });
        }

        // ---- Filters ----
        if ($request->filled('IdCateorie')) {
            $query->where('IdCateorie', $request->query('IdCateorie'));
        }

        if ($request->filled('IdUser')) {
            $query->where('IdUser', $request->query('IdUser'));
        }

        if ($request->filled('min_price')) {
            $query->where('PriceProduct', '>=', $request->query('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('PriceProduct', '<=', $request->query('max_price'));
        }

        if ($request->filled('Active')) {
            $query->where('Active', $request->query('Active'));
        }

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
