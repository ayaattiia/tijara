<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WishlistAds;
use Illuminate\Http\Request;

class WishlistAdsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            WishlistAds::class,
            [],
            ['IdUser', 'IdAd'],
            ['CreatedAt']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = WishlistAds::create($data);
        return response()->json($item, 201);
    }

    public function show($wishlist_ads)
    {
        $item = WishlistAds::findOrFail($wishlist_ads);
        return response()->json($item);
    }

    public function update(Request $request, $wishlist_ads)
    {
        $item = WishlistAds::findOrFail($wishlist_ads);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($wishlist_ads)
    {
        $item = WishlistAds::findOrFail($wishlist_ads);
        $item->delete();
        return response()->json(null, 204);
    }
}
