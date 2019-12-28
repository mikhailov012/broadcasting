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
     * @return Channel|Channel[]
     */
    public function broadcastOn()
    {
        return new Channel('chat');
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message->message
        ];
    }
}
