<?php

namespace App\Http\Controllers;

use App\Http\Requests\InjuryRequest;
use App\Models\Injury;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InjuryController extends Controller
{
    public function index(Request $request): View
    {
        $injuries = Injury::query()->with(['player', 'team', 'season'])->latest()->paginate(12);

        return view('injuries.index', compact('injuries'));
    }

    public function store(InjuryRequest $request): RedirectResponse
    {
        Injury::query()->create($request->validated());

        return back()->with('success', 'Injury tracked successfully.');
    }

    public function update(InjuryRequest $request, Injury $injury): RedirectResponse
    {
        $injury->update($request->validated());

        return back()->with('success', 'Injury updated successfully.');
    }

    public function destroy(Injury $injury): RedirectResponse
    {
        $injury->delete();

        return back()->with('success', 'Injury removed successfully.');
    }
}