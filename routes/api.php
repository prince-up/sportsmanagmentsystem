<?php

use App\Http\Controllers\Api\LeagueApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::get('/standings', [LeagueApiController::class, 'standings']);
    Route::get('/matches/upcoming', [LeagueApiController::class, 'upcomingMatches']);
});