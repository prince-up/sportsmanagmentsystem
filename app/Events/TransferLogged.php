<?php

namespace App\Events;

use App\Models\Transfer;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransferLogged implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public Transfer $transfer)
    {
    }

    public function broadcastOn(): array
    {
        return [new Channel('league.season.' . $this->transfer->season_id)];
    }

    public function broadcastAs(): string
    {
        return 'league.transfer.logged';
    }

    public function broadcastWith(): array
    {
        return [
            'player_name' => $this->transfer->player?->full_name,
            'from_team' => $this->transfer->fromTeam?->name,
            'to_team' => $this->transfer->toTeam?->name,
            'fee' => $this->transfer->transfer_fee,
            'status' => $this->transfer->status,
        ];
    }
}