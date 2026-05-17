<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Services\League\StandingsService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\View\View;

class LeagueTableController extends Controller
{
    public function __construct(private readonly StandingsService $standingsService)
    {
    }

    public function index(): View
    {
        $season = Season::query()->where('is_active', true)->firstOrFail();

        return view('league.standings', [
            'season' => $season,
            'standings' => $this->standingsService->calculate($season),
        ]);
    }

    public function exportPdf(): Response
    {
        $season = Season::query()->where('is_active', true)->firstOrFail();
        $standings = $this->standingsService->calculate($season);

        return Pdf::loadView('exports.standings', compact('season', 'standings'))
            ->download('league-standings-' . now()->format('Y-m-d') . '.pdf');
    }
}