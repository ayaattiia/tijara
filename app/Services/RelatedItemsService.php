<?php

namespace App\Services;

use App\Models\Ads;
use App\Models\Products;
use App\Models\Deals;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class RelatedItemsService
{
    /**
     * Column/relation mapping per type — Ads/Products sont en PascalCase,
     * Deals en camelCase, donc tout passe par cette config plutôt que
     * du code dupliqué en dur.
     */
    private array $config = [
        'ad' => [
            'model'     => Ads::class,
            'pk'        => 'IdAd',
            'category'  => 'IdCateg',
            'price'     => 'PriceAd',
            'brand'     => 'Brand',      // champ texte, pas de FK
            'active'    => 'Active',
            'end'       => 'DateEnd',
            'popularity' => 'ViewCount',
            'hasValues' => true,
            'pivot'     => 'AdsFeatureValues',
            'pivotKey'  => 'IdAd',
        ],
        'product' => [
            'model'     => Products::class,
            'pk'        => 'IdProduct',
            'category'  => 'IdCateg',
            'price'     => 'PriceProduct',
            'brand'     => 'IdBrand',    // FK
            'active'    => 'Active',
            'end'       => null,
            'popularity' => 'ViewCount',
            'hasValues' => true,
            'pivot'     => 'ProductsFeatureValues',
            'pivotKey'  => 'IdProduct',
        ],
        'deal' => [
            'model'     => Deals::class,
            'pk'        => 'IdDeal',
            'category'  => 'idCateg',
            'price'     => 'priceDeal',
            'brand'     => 'brand',
            'active'    => 'active',
            'end'       => 'dateEnd',
            'popularity' => 'likes',
            'hasValues' => false, // pas de table de pivot features pour deals
            'pivot'     => null,
            'pivotKey'  => null,
        ],
    ];

    public function relatedTo(Model $item, string $type, int $limit = 8): Collection
    {
        $cfg = $this->config[$type] ?? null;

        if (!$cfg) {
            return collect();
        }

        $modelClass = $cfg['model'];
        $pk = $cfg['pk'];

        $query = $modelClass::query()
            ->where($cfg['category'], $item->{$cfg['category']})
            ->where($pk, '!=', $item->{$pk})
            ->where($cfg['active'], 1);

        if ($cfg['end']) {
            $query->where(function ($q) use ($cfg) {
                $q->whereNull($cfg['end'])
                    ->orWhere($cfg['end'], '>=', now()->toDateString());
            });
        }

        $candidates = $query->limit(50)->get(); // pool large, on score ensuite

        if ($candidates->isEmpty()) {
            return collect();
        }

        $sourceValueIds = $cfg['hasValues']
            ? $this->sharedValueIds($item, $cfg)
            : collect();

        $scored = $candidates->map(function ($candidate) use ($item, $cfg, $sourceValueIds) {
            $score = 0;

            // Marque partagée
            if (!empty($item->{$cfg['brand']}) && $item->{$cfg['brand']} == $candidate->{$cfg['brand']}) {
                $score += 20;
            }

            // Prix proche (±25%)
            $sourcePrice = (float) $item->{$cfg['price']};
            $candidatePrice = (float) $candidate->{$cfg['price']};
            if ($sourcePrice > 0 && $candidatePrice > 0) {
                $diffRatio = abs($sourcePrice - $candidatePrice) / $sourcePrice;
                if ($diffRatio <= 0.25) {
                    $score += 15 * (1 - $diffRatio); // plus proche = plus de points
                }
            }

            // FeaturesValues partagées
            if ($cfg['hasValues'] && $sourceValueIds->isNotEmpty()) {
                $candidateValueIds = $candidate->values()->pluck('FeaturesValues.IdFV');
                $shared = $sourceValueIds->intersect($candidateValueIds)->count();
                if ($shared > 0) {
                    $score += 40 * ($shared / $sourceValueIds->count());
                }
            }

            // Tie-breaker popularité (petit poids, juste pour départager)
            $score += min(5, ((int) $candidate->{$cfg['popularity']}) / 100);

            $candidate->_relatedScore = round($score, 2);
            return $candidate;
        });

        return $scored
            ->sortByDesc('_relatedScore')
            ->take($limit)
            ->values();
    }

    private function sharedValueIds(Model $item, array $cfg): Collection
    {
        return $item->values()->pluck('FeaturesValues.IdFV');
    }
}
