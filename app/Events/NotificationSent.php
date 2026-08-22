<?php

namespace App\Events;

use App\Models\Notifications;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationSent implements ShouldBroadcast
{
    use InteractsWithSockets;

    public function __construct(public Notifications $notification) {}

    /**
     * Même canal privé que MessageNotification (user.{id}) - un seul
     * canal par utilisateur pour TOUT le temps réel (messages ET
     * notifications), pas besoin d'en multiplier côté frontend.
     */
    public function broadcastOn(): array
    {
        return [new PrivateChannel('user.' . $this->notification->IdUser)];
    }

    public function broadcastAs(): string
    {
        return 'notification.sent';
    }

    public function broadcastWith(): array
    {
        return [
            'IdNotification' => $this->notification->IdNotification,
            'Title'          => $this->notification->Title,
            'Description'    => $this->notification->Description,
            'Type'           => $this->notification->Type,
            'Date'           => $this->notification->Date,
            'IsRead'         => (bool) $this->notification->IsRead,
        ];
    }
}
