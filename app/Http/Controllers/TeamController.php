<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TeamController extends Controller
{
    public function index(Request $request): View
    {
        $teams = Team::query()
            ->with(['season', 'players'])
            ->when($request->string('search'), function ($query, string $search) {
                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                        ->orWhere('city', 'like', "%{$search}%")
                        ->orWhere('coach_name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('teams.index', [
            'teams' => $teams,
            'seasons' => Season::query()->orderByDesc('is_active')->get(),
        ]);
    }

    public function create(): View
    {
        return view('teams.form', [
            'team' => new Team(),
            'seasons' => Season::query()->orderByDesc('is_active')->get(),
        ]);
    }

    public function show(Team $team): View
    {
        $team->load(['season', 'players', 'homeMatches', 'awayMatches']);

        return view('teams.show', compact('team'));
    }

    public function qr(Team $team): Response
    {
        return response(
            QrCode::format('svg')->size(240)->margin(1)->generate(route('teams.show', $team)),
            200,
            ['Content-Type' => 'image/svg+xml']
        );
    }

    public function store(TeamRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['slug'] = Str::slug($data['name']);
        $data['qr_code'] = route('teams.show', ['team' => $data['slug']]);

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('teams', 'public');
        }

        Team::query()->create($data);

        return redirect()->route('teams.index')->with('success', 'Team created successfully.');
    }

    public function edit(Team $team): View
    {
        return view('teams.form', [
            'team' => $team,
            'seasons' => Season::query()->orderByDesc('is_active')->get(),
        ]);
    }

    public function update(TeamRequest $request, Team $team): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('teams', 'public');
        }

        $team->update($data);

        return redirect()->route('teams.index')->with('success', 'Team updated successfully.');
    }

    public function destroy(Team $team): RedirectResponse
    {
        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Team deleted successfully.');
    }
}