<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeasonRequest;
use App\Models\Season;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class SeasonController extends Controller
{
    public function index(Request $request): View
    {
        $seasons = Season::query()->latest()->paginate(8);

        return view('seasons.index', compact('seasons'));
    }

    public function store(SeasonRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($data['is_active'] ?? false) {
            Season::query()->update(['is_active' => false]);
        }

        Season::query()->create($data);

        return redirect()->route('seasons.index')->with('success', 'Season created successfully.');
    }

    public function update(SeasonRequest $request, Season $season): RedirectResponse
    {
        $data = $request->validated();

        if ($data['is_active'] ?? false) {
            Season::query()->whereKeyNot($season->id)->update(['is_active' => false]);
        }

        $season->update($data);

        return redirect()->route('seasons.index')->with('success', 'Season updated successfully.');
    }

    public function archive(Season $season): RedirectResponse
    {
        $season->update([
            'is_active' => false,
            'archived_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Season archived.');
    }
}