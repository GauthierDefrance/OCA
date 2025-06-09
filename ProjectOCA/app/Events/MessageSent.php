<?php
namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $message;
    public $channelId;

    public function __construct(Message $message, int $channelId)
    {
        $this->message = $message;
        $this->channelId = $channelId;
    }

    public function broadcastOn(): Channel
    {
        return new PrivateChannel('channels.' . $this->channelId);
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->message->id,
            'sender' => [
                'id' => $this->message->sender?->id,
                'name' => $this->message->sender?->name,
            ],
            'content' => $this->message->body,
            'created_at' => $this->message->created_at,
            'type' => $this->message->type,
        ];
    }


    public function broadcastAs()
    {
        return 'MessageSent';
    }

}
