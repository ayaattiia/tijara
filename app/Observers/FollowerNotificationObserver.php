<?php

namespace App\Observers;

use App\Models\UserFollows;
use App\Services\NotificationService;

/**
 * Générique pour Products, Ads, Deals: quand un vendeur publie un nouvel
 * item et qu'il a des followers (UserFollows), chacun est notifié.
 * Attaché en dehors du controller (via booted() sur chaque modèle) pour
 * ne jamais dépendre de la logique interne des 3 store() différents.
 */
class FollowerNotificationObserver
{
    public function __construct(private NotificationService $notifications) {}

    public function created($item): void
    {
        $vendorId = $item->IdUser ?? null;
        if (! $vendorId) {
            return;
        }

        $followerIds = UserFollows::where('IdVendor', $vendorId)->pluck('IdUser')->all();
        if (empty($followerIds)) {
            return;
        }

        [$title, $type, $name] = match (get_class($item)) {
            \App\Models\Products::class => ['Nouveau produit', NotificationService::TYPE_NEW_PRODUCT, $item->TitleProduct],
            \App\Models\Ads::class      => ['Nouvelle annonce', NotificationService::TYPE_NEW_AD, $item->TitleAd],
            \App\Models\Deals::class    => ['Nouveau deal', NotificationService::TYPE_NEW_DEAL, $item->title ?? $item->Title ?? null],
            default => [null, null, null],
        };

        if (! $title) {
            return;
        }

        $this->notifications->sendToMany(
            $followerIds,
            $title,
            $name ? "Le vendeur que vous suivez vient de publier : \"{$name}\"." : 'Le vendeur que vous suivez a publié un nouvel item.',
            $type
        );
    }
}
