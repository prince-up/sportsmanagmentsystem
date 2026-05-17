<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerRequest;
use App\Models\Player;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PlayerController extends Controller
{
    public function index(Request $request): View
    {
        $players = Player::query()
            ->with(['team', 'season', 'injuries'])
            ->when($request->string('search'), function ($query, string $search) {
                $query->where('full_name', 'like', "%{$search}%")
                    ->orWhere('position', 'like', "%{$search}%");
            })
            ->when($request->filled('team_id'), fn ($query) => $query->where('team_id', $request->integer('team_id')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('players.index', [
            'players' => $players,
            'teams' => Team::query()->orderBy('name')->get(),
            'seasons' => Season::query()->orderByDesc('is_active')->get(),
        ]);
    }

    public function create(): View
    {
        return view('players.form', [
            'player' => new Player(),
            'teams' => Team::query()->orderBy('name')->get(),
            'seasons' => Season::query()->orderByDesc('is_active')->get(),
        ]);
    }

    public function show(Request $request, Player $player): View
    {
        $player->load(['team', 'season', 'injuries', 'transferHistory']);

        $view = $request->routeIs('public.*') ? 'public.players.show' : 'players.show';

        return view($view, compact('player'));
    }

    public function store(PlayerRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['full_name']) . '-' . $data['jersey_number'];

        Player::query()->create($data);

        return redirect()->route('players.index')->with('success', 'Player added successfully.');
    }

    public function edit(Player $player): View
    {
        return view('players.form', [
            'player' => $player,
            'teams' => Team::query()->orderBy('name')->get(),
            'seasons' => Season::query()->orderByDesc('is_active')->get(),
        ]);
    }

    public function update(PlayerRequest $request, Player $player): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['full_name']) . '-' . $data['jersey_number'];

        $player->update($data);

        return redirect()->route('players.index')->with('success', 'Player updated successfully.');
    }

    public function destroy(Player $player): RedirectResponse
    {
        $player->delete();

        return redirect()->route('players.index')->with('success', 'Player removed successfully.');
    }
}