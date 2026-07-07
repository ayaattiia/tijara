<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WishlistDeals;
use Illuminate\Http\Request;

class WishlistDealsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            WishlistDeals::class,
            [],
            ['IdUser', 'IdDeal'],
            ['CreatedAt']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = WishlistDeals::create($data);
        return response()->json($item, 201);
    }

    public function show($wishlist_deals)
    {
        $item = WishlistDeals::findOrFail($wishlist_deals);
        return response()->json($item);
    }

    public function update(Request $request, $wishlist_deals)
    {
        $item = WishlistDeals::findOrFail($wishlist_deals);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($wishlist_deals)
    {
        $item = WishlistDeals::findOrFail($wishlist_deals);
        $item->delete();
        return response()->json(null, 204);
    }
}
