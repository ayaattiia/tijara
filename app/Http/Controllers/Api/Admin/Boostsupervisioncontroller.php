<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdBoosts;
use App\Models\ProductBoosts;
use Illuminate\Http\Request;

class BoostSupervisionController extends Controller
{
    /**
     * GET /api/admin/boosts/active
     * Vue globale admin: tous les boosts produits + annonces actuellement
     * actifs, tous vendeurs confondus.
     */
    public function index(Request $request)
    {
        $productBoosts = ProductBoosts::currentlyActive()
            ->with(['product', 'pack', 'user'])
            ->get()
            ->map(fn($b) => ['type' => 'product', 'boost' => $b]);

        $adBoosts = AdBoosts::currentlyActive()
            ->with(['ad', 'pack', 'user'])
            ->get()
            ->map(fn($b) => ['type' => 'ad', 'boost' => $b]);

        return response()->json(
            $productBoosts->concat($adBoosts)->sortByDesc(fn($x) => $x['boost']->StartDate)->values()
        );
    }

    /**
     * PATCH /api/admin/product-boosts/{id}/deactivate
     * Retrait anticipé par l'admin (abus, contenu signalé, etc).
     */
    public function deactivateProductBoost($id)
    {
        $boost = ProductBoosts::findOrFail($id);
        $boost->update(['Active' => false]);
        return response()->json(['message' => 'Boost produit désactivé.', 'data' => $boost]);
    }

    /**
     * PATCH /api/admin/ad-boosts/{id}/deactivate
     */
    public function deactivateAdBoost($id)
    {
        $boost = AdBoosts::findOrFail($id);
        $boost->update(['Active' => false]);
        return response()->json(['message' => 'Boost annonce désactivé.', 'data' => $boost]);
    }
}
