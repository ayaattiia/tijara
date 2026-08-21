<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdBoosts;
use App\Models\Ads;
use App\Services\BoostPurchaseService;
use Illuminate\Http\Request;

class AdBoostController extends Controller
{
    public function __construct(private BoostPurchaseService $boostPurchase) {}

    /**
     * POST /api/ads/{ads}/boost
     * Body: { "IdBoost": <id du pack choisi> }
     */
    public function store(Request $request, $ads)
    {
        $item = Ads::findOrFail($ads);

        if ($item->IdUser != $request->user()->IdUser) {
            return response()->json(['message' => 'Cette annonce ne vous appartient pas.'], 403);
        }

        $data = $request->validate([
            'IdBoost' => 'required|exists:BoostAdsPacks,IdBoost',
        ]);

        AdBoosts::where('IdAd', $item->IdAd)
            ->currentlyActive()
            ->update(['Active' => false]);

        $result = $this->boostPurchase->purchase($data['IdBoost'], $request->user()->IdUser);

        $boost = AdBoosts::create([
            'IdAd'      => $item->IdAd,
            'IdBoost'   => $result['pack']->IdBoost,
            'IdUser'    => $request->user()->IdUser,
            'StartDate' => $result['start'],
            'EndDate'   => $result['end'],
            'Active'    => true,
        ]);

        return response()->json([
            'message' => 'Annonce boostée avec succès.',
            'data'    => $boost->load('pack'),
        ], 201);
    }

    /**
     * GET /api/ads/{ads}/boost/status
     * Public.
     */
    public function status($ads)
    {
        $current = AdBoosts::where('IdAd', $ads)
            ->currentlyActive()
            ->with('pack')
            ->latest('EndDate')
            ->first();

        return response()->json([
            'is_boosted' => (bool) $current,
            'boost'      => $current,
        ]);
    }

    /**
     * DELETE /api/ads/{ads}/boost
     */
    public function destroy(Request $request, $ads)
    {
        $item = Ads::findOrFail($ads);

        if ($item->IdUser != $request->user()->IdUser) {
            return response()->json(['message' => 'Cette annonce ne vous appartient pas.'], 403);
        }

        $updated = AdBoosts::where('IdAd', $item->IdAd)
            ->currentlyActive()
            ->update(['Active' => false]);

        if (! $updated) {
            return response()->json(['message' => 'Aucun boost actif à retirer.'], 404);
        }

        return response()->json(['message' => 'Boost retiré.']);
    }
}
