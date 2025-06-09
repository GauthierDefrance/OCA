<?php

namespace App\Events;

use App\Models\Conversation;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GroupAccessUpdated implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public string $action; // 'added' ou 'removed'
    public array $data;
    protected int $userId;

    public function __construct(string $action, Conversation $conversation, int $userId)
    {
        $this->action = $action;
        $this->userId = $userId;

        $this->data = [
            'group_id' => $conversation->id,
            'title' => $conversation->title ?? 'Groupe sans titre',
        ];
    }

    public function broadcastOn(): array
    {
        return [new PrivateChannel("channel-updater.{$this->userId}")];
    }

    public function broadcastAs(): string
    {
        return 'GroupAccessUpdated';
    }
}
