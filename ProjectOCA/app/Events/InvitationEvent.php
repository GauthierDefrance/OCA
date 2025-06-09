<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class InvitationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $invite;

    public function __construct($invite)
    {
        $this->invite = $invite->load('conversation', 'sender', 'recipient');
    }

    public function broadcastOn()
    {
        // Canal privé basé sur l'utilisateur destinataire (exemple)
        return new PrivateChannel('invite.' . $this->invite->recipient_id);
    }

    public function broadcastWith()
    {
        return [
            'group_title' => $this->invite->conversation->title ?? 'Untitled Group',
            'inviter' => [
                'id' => $this->invite->sender->id,
                'name' => $this->invite->sender->name,
            ],
            'invitee' => [
                'id' => $this->invite->recipient->id,
                'name' => $this->invite->recipient->name,
            ],
            'channel_id' => $this->invite->conversation_id,
            'invite_id' => $this->invite->id,
        ];
    }
}
