<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
        Log::info("Evento", ["message" => $this->message]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new PrivateChannel("messages." . $this->message->user_receiver_id);
    }

    public function broadcastAs()
    {
        return "MessageSent";
    }

    public function broadcastWith()
    {
        return [
            "message" => $this->message->message,
            "user_sender_id" => $this->message->user_sender_id,
            "user_receiver_id" => $this->message->user_receiver_id,
            "created_at" => $this->message->created_at
        ];
    }
}
