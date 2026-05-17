<?php

namespace App\Services\League;

use App\Models\Player;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Support\Collection;

class TransferMarketService
{
    public function shortlist(int $seasonId): Collection
    {
        return Player::query()
            ->where('season_id', $seasonId)
            ->where('injury_status', 'fit')
            ->orderByDesc('rating')
            ->limit(12)
            ->get();
    }

    public function simulateBid(Player $player, Team $fromTeam, Team $toTeam, float $offer): array
    {
        $marketValue = (float) $player->market_value;
        $accepted = $offer >= $marketValue * 0.95 && $toTeam->budget >= $offer;

        return [
            'accepted' => $accepted,
            'status' => $accepted ? 'accepted' : 'rejected',
            'market_value' => $marketValue,
            'offer' => $offer,
            'message' => $accepted
                ? 'Offer accepted. The player can be transferred.'
                : 'Offer is below the market threshold or the buying club lacks budget.',
        ];
    }
}