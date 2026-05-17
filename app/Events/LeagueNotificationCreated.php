<?php

namespace App\Events;

use App\Models\LeagueNotification;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeagueNotificationCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public LeagueNotification $notification)
    {
    }

    public function broadcastOn(): array
    {
        return [new PrivateChannel('users.' . $this->notification->user_id)];
    }

    public function broadcastAs(): string
    {
        return 'league.notification.created';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->notification->id,
            'title' => $this->notification->title,
            'message' => $this->notification->message,
            'type' => $this->notification->type,
            'is_read' => $this->notification->is_read,
            'created_at' => $this->notification->created_at?->toDateTimeString(),
        ];
    }
}