<?php

namespace App\Services\League;

use App\Models\Season;
use App\Models\Team;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

class FixtureGeneratorService
{
    /**
     * Build a round-robin fixture list for the active season.
     */
    public function generate(?Season $season = null): Collection
    {
        $season = $season ?? Season::query()->where('is_active', true)->firstOrFail();
        $teams = Team::query()->where('season_id', $season->id)->orderBy('name')->get();

        $pairs = [];
        $kickoff = CarbonImmutable::parse($season->starts_on)->addDays(7)->setTime(18, 30);

        for ($home = 0; $home < $teams->count(); $home++) {
            for ($away = $home + 1; $away < $teams->count(); $away++) {
                $pairs[] = [
                    'season_id' => $season->id,
                    'home_team_id' => $teams[$home]->id,
                    'away_team_id' => $teams[$away]->id,
                    'venue_id' => null,
                    'match_date' => $kickoff->addDays(count($pairs) * 4)->toDateTimeString(),
                    'status' => 'scheduled',
                    'home_score' => 0,
                    'away_score' => 0,
                    'round_number' => intdiv(count($pairs), max(1, $teams->count() / 2)) + 1,
                ];
            }
        }

        return collect($pairs);
    }
}