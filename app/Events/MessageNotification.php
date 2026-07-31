<?php
namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageNotification implements ShouldBroadcast
{
    use InteractsWithSockets;

    public function __construct(
        public Message $message,
        public int $recipientId
    ) {}

    public function broadcastOn(): array
    {
        return [new PrivateChannel('user.' . $this->recipientId)];
    }

    public function broadcastWith(): array
    {
        return [
            'conversation_id' => $this->message->conversation_id,
            'message_id' => $this->message->id,
            'body' => $this->message->body,
            'created_at' => $this->message->created_at,
        ];
    }
}