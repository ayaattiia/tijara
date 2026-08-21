<?php

namespace App\Services;

use App\Models\BoostAdsPacks;
use App\Models\Wallets;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;

class BoostPurchaseService
{
    /**
     * Débite le wallet du vendeur et calcule la période de validité du
     * boost (StartDate = maintenant, EndDate = maintenant + pack.MaxDuration
     * jours). Ne crée PAS l'enregistrement product_boosts/ad_boosts lui
     * même - ça reste au contrôleur appelant, pour rester générique.
     *
     * @return array{pack: BoostAdsPacks, start: \Carbon\Carbon, end: \Carbon\Carbon}
     */
    public function purchase(int $idBoost, int $idUser): array
    {
        $pack = BoostAdsPacks::findOrFail($idBoost);

        if (! $pack->Active) {
            abort(422, 'Ce pack de boost n\'est plus disponible.');
        }

        return DB::transaction(function () use ($pack, $idUser) {
            $wallet = Wallets::where('IdUser', $idUser)->lockForUpdate()->first();

            if (! $wallet) {
                abort(422, 'Aucun wallet trouvé pour ce compte. Créez-en un avant d\'acheter un boost.');
            }

            $price = (float) $pack->Price;
            $balance = (float) $wallet->MoneyBudget;

            if ($balance < $price) {
                abort(402, "Solde insuffisant. Requis: {$price}, disponible: {$balance}.");
            }

            $wallet->MoneyBudget = $balance - $price;
            $wallet->save();

            $start = now();
            $end   = now()->addDays((int) $pack->MaxDuration);

            return [
                'pack'  => $pack,
                'start' => $start,
                'end'   => $end,
            ];
        });
    }
}
