<?php

namespace App\Events;

use App\Models\ChatMessages;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public ChatMessages $message;

    public function __construct(ChatMessages $message)
    {
        $this->message = $message;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->message->IdChat),
        ];
    }

    public function broadcastAs(): string
    {
        return 'message.sent';
    }

    public function broadcastWith(): array
    {
        return [
            'IdChatMessage' => $this->message->IdChatMessage,
            'IdChat'        => $this->message->IdChat,
            'IdUserSender'  => $this->message->IdUserSender,
            'Message'       => $this->message->Message,
            'CreateDate'    => $this->message->CreateDate,
        ];
    }
}