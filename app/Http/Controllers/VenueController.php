<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenueRequest;
use App\Models\Venue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VenueController extends Controller
{
    public function index(Request $request): View
    {
        $venues = Venue::query()
            ->when($request->string('search'), function ($query, string $search) {
                $query->where('name', 'like', "%{$search}%")->orWhere('city', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('venues.index', compact('venues'));
    }

    public function store(VenueRequest $request): RedirectResponse
    {
        Venue::query()->create($request->validated());

        return redirect()->route('venues.index')->with('success', 'Venue saved successfully.');
    }

    public function update(VenueRequest $request, Venue $venue): RedirectResponse
    {
        $venue->update($request->validated());

        return redirect()->route('venues.index')->with('success', 'Venue updated successfully.');
    }

    public function destroy(Venue $venue): RedirectResponse
    {
        $venue->delete();

        return redirect()->route('venues.index')->with('success', 'Venue removed successfully.');
    }
}