<?php

use Illuminate\Support\Collection;

if (! function_exists('league_points_for_match')) {
    function league_points_for_match(int $teamGoals, int $opponentGoals): array
    {
        if ($teamGoals > $opponentGoals) {
            return ['wins' => 1, 'draws' => 0, 'losses' => 0, 'points' => 3];
        }

        if ($teamGoals === $opponentGoals) {
            return ['wins' => 0, 'draws' => 1, 'losses' => 0, 'points' => 1];
        }

        return ['wins' => 0, 'draws' => 0, 'losses' => 1, 'points' => 0];
    }
}

if (! function_exists('league_sort_standings')) {
    /**
     * Sort standings the same way the league table is displayed.
     */
    function league_sort_standings(Collection $standings): Collection
    {
        return $standings->sortByDesc(function (array $row) {
            return [
                $row['points'],
                $row['goal_difference'],
                $row['goals_for'],
                $row['fair_play_points'],
                -$row['losses'],
            ];
        })->values();
    }
}

if (! function_exists('league_slug')) {
    function league_slug(string $value): string
    {
        return str($value)->slug()->toString();
    }
}