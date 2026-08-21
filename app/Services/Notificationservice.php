<?php

namespace App\Services;

use App\Models\Notifications;

/**
 * NotificationService
 * =====================
 * Single entry point for creating notifications anywhere in the project.
 *
 * Instead of every controller doing:
 *      Notifications::create(['Title' => ..., 'Description' => ..., ...]);
 * (which is exactly the copy-pasted block already living inside
 * AdBoostsController), everything should call:
 *
 *      NotificationService::send($userId, 'Boost activated', 'Your ad is boosted...', 'boost');
 *
 * This keeps the Notifications table's shape (Title/Description/Date/Type/
 * IsRead/IdUser) consistent no matter which feature is triggering it, and
 * gives one place to later add things like push notifications, email
 * fan-out, or broadcasting — without touching every controller that
 * currently sends a notification.
 */
class NotificationService
{
    /**
     * Send a single notification to one user.
     */
    public static function send(int $userId, string $title, string $description, string $type = 'default'): Notifications
    {
        return Notifications::create([
            'Title'       => $title,
            'Description' => $description,
            'Date'        => now()->toDateString(),
            'Type'        => $type,
            'IsRead'      => 0,
            'IdUser'      => $userId,
        ]);
    }

    /**
     * Send the same notification to several users at once
     * (e.g. notify every admin when a new Réclamation comes in).
     */
    public static function sendToMany(array $userIds, string $title, string $description, string $type = 'default'): void
    {
        foreach ($userIds as $userId) {
            static::send($userId, $title, $description, $type);
        }
    }

    /**
     * Convenience: notify every admin (IdRole = 3).
     * Used by Réclamations so support staff see new tickets immediately.
     */
    public static function notifyAdmins(string $title, string $description, string $type = 'default'): void
    {
        $adminIds = \App\Models\Users::where('IdRole', 3)->pluck('IdUser')->all();
        static::sendToMany($adminIds, $title, $description, $type);
    }
}
