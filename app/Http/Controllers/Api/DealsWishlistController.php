<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DealsWishlist;
use Illuminate\Http\Request;

class DealsWishlistController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            DealsWishlist::class,
            [],
            ['IdUser', 'IdDeal', 'Liked'],
            []
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = DealsWishlist::create($data);
        return response()->json($item, 201);
    }

    public function show($deals_wishlist)
    {
        $item = DealsWishlist::findOrFail($deals_wishlist);
        return response()->json($item);
    }

    public function update(Request $request, $deals_wishlist)
    {
        $item = DealsWishlist::findOrFail($deals_wishlist);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($deals_wishlist)
    {
        $item = DealsWishlist::findOrFail($deals_wishlist);
        $item->delete();
        return response()->json(null, 204);
    }
}
