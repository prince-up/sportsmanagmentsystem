<?php

namespace App\Events;

use App\Models\Injury;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InjuryLogged implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Injury $injury)
    {
    }

    public function broadcastOn(): array
    {
        return [new Channel('league.season.' . $this->injury->season_id)];
    }

    public function broadcastAs(): string
    {
        return 'league.injury.logged';
    }

    public function broadcastWith(): array
    {
        return [
            'player_name' => $this->injury->player?->full_name,
            'team_name' => $this->injury->team?->name,
            'injury_type' => $this->injury->injury_type,
            'severity' => $this->injury->severity,
            'recovery_progress' => $this->injury->recovery_progress,
        ];
    }
}