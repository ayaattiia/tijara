<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    // Centralize the default/min/max so you can tweak them in one place
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    // Relations to eager-load so each ad automatically shows its feature/value details
    private const FEATURES_RELATIONS = ['feature', 'featureValue'];

    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = $this->buildFilteredQuery(
            $request,
            Ads::class,
            ['TitleAd', 'DescriptionAd', 'DetailsAd', 'LocationAd', 'Telephone', 'Email'],
            ['IdPricesDelevery', 'ImageAd', 'VideoAd', 'IdCateg', 'IdUser', 'Color', 'Brand', 'Ownerads', 'Idtypecat', 'Active', 'Type', 'IdFeature', 'IdFV'],
            ['PriceAd', 'DatePublication', 'DateEnd', 'StartDate']
        )->with(self::FEATURES_RELATIONS);

        return response()->json($query->paginate($perPage));
    }
    public function store(Request $request)
    {
        $request->validate([
            'TitleAd'       => 'required|string|max:250',
            'DescriptionAd' => 'nullable|string',
            'PriceAd'       => 'required',
            'ImageAd'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data = $request->except('ImageAd'); // don't pass the raw file into create()

        if ($request->hasFile('ImageAd')) {
            $data['ImageAd'] = $request->file('ImageAd')->store('images/ads', 'public');
        }

        $item = Ads::create($data);

        return response()->json([
            'data' => $item->load(self::FEATURES_RELATIONS),
            'image_url' => $item->ImageAd ? asset('storage/' . $item->ImageAd) : null,
        ], 201);
    }

    public function show($ads)
    {
        $item = Ads::with(self::FEATURES_RELATIONS)->findOrFail($ads);
        return response()->json($item);
    }

    public function update(Request $request, $ads)
    {
        $item = Ads::findOrFail($ads);
        $item->update($request->all());
        return response()->json($item->load(self::FEATURES_RELATIONS));
    }

    public function destroy($ads)
    {
        $item = Ads::findOrFail($ads);
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
