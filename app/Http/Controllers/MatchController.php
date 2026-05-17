<?php

namespace App\Http\Controllers;

use App\Events\MatchLiveUpdated;
use App\Http\Requests\MatchRequest;
use App\Models\MatchModel;
use App\Models\Player;
use App\Models\Season;
use App\Models\Team;
use App\Models\Venue;
use App\Services\League\PredictionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MatchController extends Controller
{
    public function __construct(private readonly PredictionService $predictionService)
    {
    }

    public function index(Request $request): View
    {
        $matches = MatchModel::query()
            ->with(['season', 'venue', 'homeTeam', 'awayTeam', 'mvpPlayer'])
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->latest('match_date')
            ->paginate(12)
            ->withQueryString();

        return view('matches.index', [
            'matches' => $matches,
            'seasons' => Season::query()->orderByDesc('is_active')->get(),
            'teams' => Team::query()->orderBy('name')->get(),
            'venues' => Venue::query()->orderBy('name')->get(),
            'predictions' => $matches->getCollection()->mapWithKeys(function (MatchModel $match) {
                return [$match->id => $this->predictionService->predict($match)];
            }),
        ]);
    }

    public function store(MatchRequest $request): RedirectResponse
    {
        MatchModel::query()->create($request->validated());

        return redirect()->route('matches.index')->with('success', 'Match scheduled successfully.');
    }

    public function show(Request $request, MatchModel $match): View
    {
        $match->load(['season', 'venue', 'homeTeam.players', 'awayTeam.players', 'mvpPlayer', 'votes.player']);

        $view = $request->routeIs('public.*') ? 'public.matches.show' : 'matches.show';

        return view($view, compact('match'));
    }

    public function update(MatchRequest $request, MatchModel $match): RedirectResponse
    {
        $match->update($request->validated());

        return redirect()->route('matches.index')->with('success', 'Match updated successfully.');
    }

    public function destroy(MatchModel $match): RedirectResponse
    {
        $match->delete();

        return redirect()->route('matches.index')->with('success', 'Match removed successfully.');
    }

    public function vote(Request $request, MatchModel $match): RedirectResponse
    {
        $data = $request->validate([
            'player_id' => ['required', 'exists:players,id'],
            'points' => ['required', 'integer', 'min:1', 'max:5'],
            'reason' => ['nullable', 'string', 'max:500'],
        ]);

        $match->votes()->updateOrCreate(
            ['player_id' => $data['player_id'], 'voted_by_user_id' => $request->user()->id],
            $data
        );

        return back()->with('success', 'Vote recorded successfully.');
    }

    public function liveUpdate(Request $request, MatchModel $match): RedirectResponse
    {
        $data = $request->validate([
            'home_score' => ['required', 'integer', 'min:0'],
            'away_score' => ['required', 'integer', 'min:0'],
            'live_status' => ['nullable', 'string', 'max:120'],
            'highlights' => ['nullable', 'string'],
        ]);

        $data['status'] = 'live';
        $match->update($data);
        $match->load(['homeTeam', 'awayTeam']);

        event(new MatchLiveUpdated($match));

        return back()->with('success', 'Live score updated.');
    }
}