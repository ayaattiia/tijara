<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductBoosts;
use App\Models\Products;
use App\Services\BoostPurchaseService;
use Illuminate\Http\Request;

class ProductBoostController extends Controller
{
    public function __construct(private BoostPurchaseService $boostPurchase) {}

    /**
     * POST /api/products/{product}/boost
     * Body: { "IdBoost": <id du pack choisi> }
     * Le vendeur achète un boost pour SON produit. Le prix est débité de
     * son wallet, la période de validité calculée depuis pack.MaxDuration.
     */
    public function store(Request $request, $product)
    {
        $item = Products::findOrFail($product);

        if ($item->IdUser != $request->user()->IdUser) {
            return response()->json(['message' => 'Ce produit ne vous appartient pas.'], 403);
        }

        $data = $request->validate([
            'IdBoost' => 'required|exists:BoostAdsPacks,IdBoost',
        ]);

        // Un seul boost actif à la fois par produit - on désactive
        // l'ancien s'il y en avait un encore valide, plutôt que de les
        // cumuler silencieusement.
        ProductBoosts::where('IdProduct', $item->IdProduct)
            ->currentlyActive()
            ->update(['Active' => false]);

        $result = $this->boostPurchase->purchase($data['IdBoost'], $request->user()->IdUser);

        $boost = ProductBoosts::create([
            'IdProduct'  => $item->IdProduct,
            'IdBoost'    => $result['pack']->IdBoost,
            'IdUser'     => $request->user()->IdUser,
            'StartDate'  => $result['start'],
            'EndDate'    => $result['end'],
            'Active'     => true,
        ]);

        return response()->json([
            'message' => 'Produit boosté avec succès.',
            'data'    => $boost->load('pack'),
        ], 201);
    }

    /**
     * GET /api/products/{product}/boost/status
     * Public - permet à n'importe qui (front, autre vendeur) de savoir si
     * ce produit est actuellement boosté.
     */
    public function status($product)
    {
        $current = ProductBoosts::where('IdProduct', $product)
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
     * DELETE /api/products/{product}/boost
     * Le vendeur retire son propre boost en avance. Pas de remboursement -
     * c'est un achat déjà consommé.
     */
    public function destroy(Request $request, $product)
    {
        $item = Products::findOrFail($product);

        if ($item->IdUser != $request->user()->IdUser) {
            return response()->json(['message' => 'Ce produit ne vous appartient pas.'], 403);
        }

        $updated = ProductBoosts::where('IdProduct', $item->IdProduct)
            ->currentlyActive()
            ->update(['Active' => false]);

        if (! $updated) {
            return response()->json(['message' => 'Aucun boost actif à retirer.'], 404);
        }

        return response()->json(['message' => 'Boost retiré.']);
    }
}
