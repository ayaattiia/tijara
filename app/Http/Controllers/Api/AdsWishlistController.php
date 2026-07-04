<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdsWishlist;
use Illuminate\Http\Request;

class AdsWishlistController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(AdsWishlist::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = AdsWishlist::create($data);
        return response()->json($item, 201);
    }

    public function show($ads_wishlist)
    {
        $item = AdsWishlist::findOrFail($ads_wishlist);
        return response()->json($item);
    }

    public function update(Request $request, $ads_wishlist)
    {
        $item = AdsWishlist::findOrFail($ads_wishlist);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($ads_wishlist)
    {
        $item = AdsWishlist::findOrFail($ads_wishlist);
        $item->delete();
        return response()->json(null, 204);
    }
}
