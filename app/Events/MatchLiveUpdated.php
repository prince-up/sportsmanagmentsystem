<?php

namespace App\Events;

use App\Models\MatchModel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MatchLiveUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public MatchModel $match)
    {
    }

    public function broadcastOn(): array
    {
        return [new Channel('league.season.' . $this->match->season_id)];
    }

    public function broadcastAs(): string
    {
        return 'match.live.updated';
    }

    public function broadcastWith(): array
    {
        return [
            'match_id' => $this->match->id,
            'season_id' => $this->match->season_id,
            'home_team' => $this->match->homeTeam?->name,
            'away_team' => $this->match->awayTeam?->name,
            'home_score' => $this->match->home_score,
            'away_score' => $this->match->away_score,
            'status' => $this->match->status,
            'live_status' => $this->match->live_status,
            'updated_at' => $this->match->updated_at?->toDateTimeString(),
        ];
    }
}