<?php

namespace App\Events;

use App\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Message
     */
    private $message;

    /**
     * ChatMessage constructor.
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        //
        $this->message = $message;
    }

    /**
     * @return Channel|Channel[]|PresenceChannel
     */
    public function broadcastOn()
    {
        return new PresenceChannel('chat');
    }

    public function broadcastWith()
    {
        return [
            'name' => $this->message->user->name,
            'message' => $this->message->message
        ];
    }
}
