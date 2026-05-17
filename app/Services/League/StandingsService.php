<?php

namespace App\Services\League;

use App\Models\MatchModel;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Support\Collection;

class StandingsService
{
    public function calculate(?Season $season = null): Collection
    {
        $season = $season ?? Season::query()->where('is_active', true)->firstOrFail();

        $teams = Team::query()
            ->where('season_id', $season->id)
            ->withCount(['homeMatches as home_matches_count', 'awayMatches as away_matches_count'])
            ->orderBy('name')
            ->get();

        $matches = MatchModel::query()
            ->where('season_id', $season->id)
            ->where('status', 'completed')
            ->get();

        $standings = $teams->map(function (Team $team) use ($matches) {
            $teamMatches = $matches->filter(function (MatchModel $match) use ($team) {
                return (int) $match->home_team_id === (int) $team->id || (int) $match->away_team_id === (int) $team->id;
            });

            $row = [
                'team_id' => $team->id,
                'team_name' => $team->name,
                'played' => $teamMatches->count(),
                'wins' => 0,
                'draws' => 0,
                'losses' => 0,
                'goals_for' => 0,
                'goals_against' => 0,
                'goal_difference' => 0,
                'points' => 0,
                'fair_play_points' => (int) $team->fair_play_points,
                'budget' => (float) $team->budget,
            ];

            foreach ($teamMatches as $match) {
                $isHome = (int) $match->home_team_id === (int) $team->id;
                $teamGoals = $isHome ? (int) $match->home_score : (int) $match->away_score;
                $opponentGoals = $isHome ? (int) $match->away_score : (int) $match->home_score;

                $row['goals_for'] += $teamGoals;
                $row['goals_against'] += $opponentGoals;

                $result = league_points_for_match($teamGoals, $opponentGoals);
                $row['wins'] += $result['wins'];
                $row['draws'] += $result['draws'];
                $row['losses'] += $result['losses'];
                $row['points'] += $result['points'];
            }

            $row['goal_difference'] = $row['goals_for'] - $row['goals_against'];

            return $row;
        });

        return league_sort_standings($standings);
    }
}