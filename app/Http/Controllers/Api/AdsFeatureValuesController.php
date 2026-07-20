<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdsFeatureValues;
use Illuminate\Http\Request;

class AdsFeatureValuesController extends Controller
{
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    public function index(Request $request)
    {
        $perPage = max(
            self::MIN_PER_PAGE,
            min((int)$request->query('per_page', self::DEFAULT_PER_PAGE), self::MAX_PER_PAGE)
        );

        return response()->json(
            AdsFeatureValues::with(['ad', 'featureValue'])->paginate($perPage)
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'IdAd' => 'required|exists:Ads,IdAd',
            'IdFV' => 'required|exists:FeaturesValues,IdFV',
        ]);

        $item = AdsFeatureValues::create($request->all());

        return response()->json(
            $item->load(['ad', 'featureValue']),
            201
        );
    }

    public function show($id)
    {
        $item = AdsFeatureValues::with(['ad', 'featureValue'])
            ->findOrFail($id);

        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'IdAd' => 'required|exists:Ads,IdAd',
            'IdFV' => 'required|exists:FeaturesValues,IdFV',
        ]);

        $item = AdsFeatureValues::findOrFail($id);

        $item->update($request->all());

        return response()->json(
            $item->load(['ad', 'featureValue'])
        );
    }

    public function destroy($id)
    {
        $item = AdsFeatureValues::findOrFail($id);

        $item->delete();

        return response()->json(null, 204);
    }
}
