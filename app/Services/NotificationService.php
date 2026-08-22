<?php

namespace App\Services;

use App\Events\NotificationSent;
use App\Models\Notifications;
use App\Models\Users;

class NotificationService
{
    /**
     * Types métier standardisés - utilisés côté frontend pour choisir
     * l'icône/route à afficher pour chaque notification.
     */
    public const TYPE_ORDER_RECEIVED   = 'order_received';    // vendeur: nouvelle commande
    public const TYPE_ORDER_ACCEPTED   = 'order_accepted';    // acheteur
    public const TYPE_ORDER_REJECTED   = 'order_rejected';    // acheteur
    public const TYPE_ORDER_SHIPPED    = 'order_shipped';     // acheteur
    public const TYPE_ORDER_CANCELLED  = 'order_cancelled';   // vendeur
    public const TYPE_DELIVERY_UPDATE  = 'delivery_update';   // acheteur
    public const TYPE_REPORT_RECEIVED  = 'report_received';   // admin
    public const TYPE_REPORT_RESOLVED  = 'report_resolved';   // auteur du signalement
    public const TYPE_VERIFICATION_OK  = 'verification_approved'; // vendeur
    public const TYPE_VERIFICATION_KO  = 'verification_rejected'; // vendeur
    public const TYPE_BOOST_ACTIVATED  = 'boost_activated';   // vendeur
    public const TYPE_NEW_PRODUCT      = 'new_product';       // followers
    public const TYPE_NEW_AD           = 'new_ad';            // followers
    public const TYPE_NEW_DEAL         = 'new_deal';          // followers

    /**
     * Point d'entrée UNIQUE pour toute la plateforme: persiste en base
     * (pour l'historique/le badge non-lus) ET pousse en temps réel via
     * WebSocket (Reverb) sur le canal privé user.{id} de ce destinataire.
     * Si le WebSocket est down, la notification reste quand même en base
     * - le frontend peut toujours la retrouver via GET /api/notifications.
     */
    public function send(int $idUser, string $title, ?string $description, string $type): Notifications
    {
        $notification = Notifications::create([
            'Title'       => $title,
            'Description' => $description,
            'Type'        => $type,
            'Date'        => now()->toDateString(),
            'IsRead'      => 0,
            'IdUser'      => $idUser,
        ]);

        broadcast(new NotificationSent($notification))->toOthers();

        return $notification;
    }

    /**
     * Envoie la même notification à plusieurs utilisateurs (ex: tous les
     * admins pour un nouveau signalement).
     */
    public function sendToMany(array $idUsers, string $title, ?string $description, string $type): void
    {
        foreach ($idUsers as $idUser) {
            $this->send($idUser, $title, $description, $type);
        }
    }

    /**
     * Raccourci pour notifier tous les admins (IdRole = 3).
     */
    public function sendToAdmins(string $title, ?string $description, string $type): void
    {
        $adminIds = Users::where('IdRole', 3)->pluck('IdUser')->all();
        $this->sendToMany($adminIds, $title, $description, $type);
    }
}
