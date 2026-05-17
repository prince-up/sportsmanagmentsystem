<?php

namespace App\Services\League;

use App\Models\MatchModel;

class PredictionService
{
    public function predict(MatchModel $match): array
    {
        $homeRating = (float) ($match->homeTeam?->players()->avg('rating') ?? 6.5);
        $awayRating = (float) ($match->awayTeam?->players()->avg('rating') ?? 6.5);
        $homeEdge = ((float) $match->homeTeam?->budget - (float) $match->awayTeam?->budget) / 100000;

        $homeScore = max(0, round(($homeRating - 5.5) + $homeEdge + 1.2, 0));
        $awayScore = max(0, round(($awayRating - 5.5) + 0.8, 0));

        if ($homeScore === $awayScore) {
            $winner = 'draw';
        } elseif ($homeScore > $awayScore) {
            $winner = $match->homeTeam?->name;
        } else {
            $winner = $match->awayTeam?->name;
        }

        return [
            'winner' => $winner,
            'home_score' => $homeScore,
            'away_score' => $awayScore,
            'confidence' => min(92, max(55, 60 + abs($homeRating - $awayRating) * 4)),
        ];
    }
}