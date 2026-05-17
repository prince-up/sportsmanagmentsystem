@extends('layouts.app')

@section('page-title', $team->name)

@section('content')
    <div class="grid gap-6 lg:grid-cols-[1fr_320px]">
        <div class="space-y-6">
            <div class="card p-6">
                <x-section-heading :title="$team->name" :subtitle="$team->coach_name . ' · ' . $team->city"></x-section-heading>
                <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                    <x-stat-card label="Budget" :value="'$'.number_format((float) $team->budget, 2)" tone="emerald" />
                    <x-stat-card label="Spent" :value="'$'.number_format((float) $team->spent_budget, 2)" tone="amber" />
                    <x-stat-card label="Fair play" :value="$team->fair_play_points" tone="sky" />
                    <x-stat-card label="Players" :value="$team->players->count()" tone="rose" />
                </div>
            </div>

            <div class="card p-6">
                <h2 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">Players</h2>
                <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach($team->players as $player)
                        <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <p class="font-medium text-slate-900 dark:text-white">{{ $player->full_name }}</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">#{{ $player->jersey_number }} · {{ $player->position }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="card p-6 text-center">
                <h2 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">QR Profile</h2>
                <img class="mx-auto h-56 w-56 rounded-2xl border border-slate-200 bg-white p-3 dark:border-slate-800" src="{{ route('teams.qr', $team) }}" alt="Team QR code">
                <p class="mt-4 text-sm text-slate-500 dark:text-slate-400">Scan to open the public team profile.</p>
            </div>

            <div class="card p-6">
                <h2 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">Match summary</h2>
                <div class="space-y-3 text-sm text-slate-600 dark:text-slate-300">
                    <p>Home matches: {{ $team->homeMatches->count() }}</p>
                    <p>Away matches: {{ $team->awayMatches->count() }}</p>
                    <p>Season: {{ $team->season?->name }}</p>
                </div>
            </div>
        </aside>
    </div>
@endsection