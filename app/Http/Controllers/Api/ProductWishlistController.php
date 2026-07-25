<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductWishlist;
use Illuminate\Http\Request;

class ProductWishlistController extends Controller
{
    // Centralize the default/min/max so you can tweak them in one place
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = $this->buildFilteredQuery(
            $request,
            ProductWishlist::class,
            [],
            ['IdUser', 'IdProduct', 'Liked'],
            []
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = ProductWishlist::create($data);
        return response()->json($item, 201);
    }

    public function show($product_wishlist)
    {
        $item = ProductWishlist::findOrFail($product_wishlist);
        return response()->json($item);
    }

    public function update(Request $request, $product_wishlist)
    {
        $item = ProductWishlist::findOrFail($product_wishlist);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($product_wishlist)
    {
        $item = ProductWishlist::findOrFail($product_wishlist);
        $item->delete();
        return response()->json(null, 204);
    }
    /**
     * POST /api/product-wishlist/add
     * Body: { "IdUser": 1, "IdProduct": 10, "Liked": 1 }
     */
    public function addToWishlist(Request $request)
    {
        $request->validate([
            'IdUser'    => 'required|integer',
            'IdProduct' => 'required|integer',
            'Liked'     => 'nullable|boolean',
        ]);

        $existing = ProductWishlist::where('IdUser', $request->IdUser)
            ->where('IdProduct', $request->IdProduct)
            ->first();

        if ($existing) {
            return response()->json([
                'message' => 'Already in wishlist.',
                'data'    => $existing,
            ], 200);
        }

        $item = ProductWishlist::create([
            'IdUser'    => $request->IdUser,
            'IdProduct' => $request->IdProduct,
            'Liked'     => $request->input('Liked', 1),
        ]);

        return response()->json([
            'message' => 'Added to wishlist.',
            'data'    => $item,
        ], 201);
    }

    /**
     * DELETE /api/product-wishlist/remove
     * Body/query: { "IdUser": 1, "IdProduct": 10 }
     */
    public function removeFromWishlist(Request $request)
    {
        $request->validate([
            'IdUser'    => 'required|integer',
            'IdProduct' => 'required|integer',
        ]);

        $existing = ProductWishlist::where('IdUser', $request->IdUser)
            ->where('IdProduct', $request->IdProduct)
            ->first();

        if (!$existing) {
            return response()->json([
                'message' => 'Already removed from wishlist.',
            ], 200);
        }

        $existing->delete();

        return response()->json([
            'message' => 'Removed from wishlist.',
        ], 200);
    }
    /**
     * Resolve the per_page value from the request, falling back to a default
     * and clamping it between MIN_PER_PAGE and MAX_PER_PAGE.
     */
    private function resolvePerPage(Request $request): int
    {
        $perPage = (int) $request->query('per_page', self::DEFAULT_PER_PAGE);

        // Guard against negatives or absurdly large values
        return max(self::MIN_PER_PAGE, min($perPage, self::MAX_PER_PAGE));
    }
}
