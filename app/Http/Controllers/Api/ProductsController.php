<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // Centralize the default/min/max so you can tweak them in one place
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    // Relations to eager-load so each product automatically shows its feature/value details
    private const FEATURES_RELATIONS = ['feature', 'featureValue'];

    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = $this->buildFilteredQuery(
            $request,
            Products::class,
            ['CodeBarProduct', 'CodeProduct', 'ReferenceProduct', 'TitleProduct', 'DescriptionProduct'],
            ['ColorProduct', 'TvaProduct', 'IdPricesDelevery', 'ImageProduct', 'VideoProduct', 'IdPrize', 'IdCateorie', 'IdUser', 'Active', 'IdFeature', 'IdFV'],
            ['QuantityProduct', 'PriceProduct']
        )->with(self::FEATURES_RELATIONS);

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Products::create($data);
        return response()->json($item->load(self::FEATURES_RELATIONS), 201);
    }

    public function show($products)
    {
        $item = Products::with(self::FEATURES_RELATIONS)->findOrFail($products);
        return response()->json($item);
    }

    public function update(Request $request, $products)
    {
        $item = Products::findOrFail($products);
        $item->update($request->all());
        return response()->json($item->load(self::FEATURES_RELATIONS));
    }

    public function destroy($products)
    {
        $item = Products::findOrFail($products);
        $item->delete();
        return response()->json(null, 204);
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
