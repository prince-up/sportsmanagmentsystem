<?php

namespace App\Http\Controllers;

use App\Models\Injury;
use App\Models\MatchModel;
use App\Models\LeagueNotification;
use App\Models\Player;
use App\Models\Season;
use App\Models\Transfer;
use App\Services\League\StandingsService;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private readonly StandingsService $standingsService)
    {
    }

    public function __invoke(): View
    {
        $season = Season::query()->where('is_active', true)->firstOrFail();
        $table = $this->standingsService->calculate($season);
        $leader = $table->first();
        $topAttack = $table->sortByDesc('goals_for')->first();
        $bestDefense = $table->sortBy('goals_against')->first();
        $completedMatches = MatchModel::query()->where('season_id', $season->id)->where('status', 'completed')->count();
        $scheduledMatches = MatchModel::query()->where('season_id', $season->id)->where('status', 'scheduled')->count();
        $liveMatches = MatchModel::query()->where('season_id', $season->id)->where('status', 'live')->count();
        $totalPlayers = Player::query()->where('season_id', $season->id)->count();
        $totalVenues = MatchModel::query()->where('season_id', $season->id)->distinct('venue_id')->count('venue_id');

        return view('dashboard', [
            'season' => $season,
            'standings' => $table->take(5),
            'topTeams' => $table->take(3),
            'table' => $table,
            'leader' => $leader,
            'topAttack' => $topAttack,
            'bestDefense' => $bestDefense,
            'completedMatches' => $completedMatches,
            'scheduledMatches' => $scheduledMatches,
            'liveMatches' => $liveMatches,
            'totalPlayers' => $totalPlayers,
            'totalVenues' => $totalVenues,
            'upcomingMatches' => MatchModel::query()->where('season_id', $season->id)->where('status', 'scheduled')->orderBy('match_date')->limit(5)->get(),
            'recentMatches' => MatchModel::query()->with(['homeTeam', 'awayTeam', 'venue'])->where('season_id', $season->id)->where('status', 'completed')->latest('match_date')->limit(4)->get(),
            'injuredPlayers' => Injury::query()->with('player')->whereNull('recovered_at')->orderByDesc('recovery_progress')->limit(5)->get(),
            'recentTransfers' => Transfer::query()->with(['player', 'fromTeam', 'toTeam'])->orderByDesc('created_at')->limit(5)->get(),
            'notifications' => LeagueNotification::query()->when(auth()->id(), fn ($query) => $query->where('user_id', auth()->id()))->latest()->limit(5)->get(),
        ]);
    }
}