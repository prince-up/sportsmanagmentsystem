<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InjuryController;
use App\Http\Controllers\LeagueTableController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\VenueController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/public/teams/{team}', [TeamController::class, 'show'])->name('public.teams.show');
Route::get('/public/players/{player}', [PlayerController::class, 'show'])->name('public.players.show');
Route::get('/public/matches/{match}', [MatchController::class, 'show'])->name('public.matches.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/league/standings', [LeagueTableController::class, 'index'])->name('league.standings');
    Route::get('/league/standings/export', [LeagueTableController::class, 'exportPdf'])->name('league.standings.export');

    Route::resource('teams', TeamController::class)->except(['show']);
    Route::get('/teams/{team}/qr', [TeamController::class, 'qr'])->name('teams.qr');
    Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
    Route::resource('players', PlayerController::class)->except(['show']);
    Route::resource('matches', MatchController::class)->except(['show', 'create', 'edit']);
    Route::resource('venues', VenueController::class)->except(['show', 'create', 'edit']);
    Route::resource('seasons', SeasonController::class)->except(['show', 'create', 'edit', 'destroy']);
    Route::resource('transfers', TransferController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('injuries', InjuryController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::patch('/matches/{match}/live', [MatchController::class, 'liveUpdate'])->name('matches.live-update');
    Route::post('/matches/{match}/vote', [MatchController::class, 'vote'])->name('matches.vote');
    Route::patch('/seasons/{season}/archive', [SeasonController::class, 'archive'])->name('seasons.archive');
});

require __DIR__ . '/auth.php';