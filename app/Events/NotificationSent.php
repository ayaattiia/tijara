<?php

namespace App\Events;

use App\Models\Notifications;
use Carbon\Carbon;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class NotificationSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public function __construct(public Notifications $notification) {}

    /**
     * Canal privé du destinataire.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel(
                'user.' . $this->notification->IdUser
            )
        ];
    }

    /**
     * Nom de l'événement Reverb.
     */
    public function broadcastAs(): string
    {
        return 'notification.sent';
    }

    /**
     * Données envoyées au frontend.
     */
    public function broadcastWith(): array
    {
        return [
            'IdNotification' => $this->notification->IdNotification,

            'Title' => $this->notification->Title,

            'Description' => $this->notification->Description,

            'Type' => $this->notification->Type,

            /*
             * Date + heure + minutes + secondes
             */
            'Date' => now(),

            'IsRead' => (bool) $this->notification->IsRead,
        ];
    }
}
