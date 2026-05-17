<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MatchModel;
use App\Models\Season;
use App\Services\League\PredictionService;
use App\Services\League\StandingsService;
use Illuminate\Http\JsonResponse;

class LeagueApiController extends Controller
{
    public function __construct(
        private readonly StandingsService $standingsService,
        private readonly PredictionService $predictionService,
    ) {
    }

    public function standings(): JsonResponse
    {
        $season = Season::query()->where('is_active', true)->firstOrFail();

        return response()->json([
            'season' => $season->name,
            'data' => $this->standingsService->calculate($season),
        ]);
    }

    public function upcomingMatches(): JsonResponse
    {
        $season = Season::query()->where('is_active', true)->firstOrFail();
        $matches = MatchModel::query()->with(['homeTeam', 'awayTeam', 'venue'])->where('season_id', $season->id)->where('status', 'scheduled')->orderBy('match_date')->limit(10)->get();

        return response()->json([
            'data' => $matches->map(fn (MatchModel $match) => [
                'id' => $match->id,
                'home_team' => $match->homeTeam?->name,
                'away_team' => $match->awayTeam?->name,
                'match_date' => $match->match_date?->toDateTimeString(),
                'venue' => $match->venue?->name,
                'prediction' => $this->predictionService->predict($match),
            ]),
        ]);
    }
}