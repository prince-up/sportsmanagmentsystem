<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $team->name }} · Team Profile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-white">
<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
    <a class="btn-secondary mb-6 inline-flex" href="/">Back to home</a>

    <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
        <section class="card p-6">
            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-brand-600">Public team profile</p>
            <h1 class="mt-3 text-3xl font-semibold">{{ $team->name }}</h1>
            <p class="mt-2 text-slate-500 dark:text-slate-400">{{ $team->coach_name }} · {{ $team->city }}</p>

            <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <x-stat-card label="Budget" :value="'$'.number_format((float) $team->budget, 2)" tone="emerald" />
                <x-stat-card label="Spent" :value="'$'.number_format((float) $team->spent_budget, 2)" tone="amber" />
                <x-stat-card label="Fair play" :value="$team->fair_play_points" tone="sky" />
                <x-stat-card label="Players" :value="$team->players->count()" tone="rose" />
            </div>

            <div class="mt-8">
                <h2 class="text-lg font-semibold">Squad</h2>
                <div class="mt-4 grid gap-3 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach($team->players as $player)
                        <a class="rounded-2xl border border-slate-200 p-4 transition hover:border-brand-400 hover:bg-brand-50 dark:border-slate-800 dark:hover:bg-slate-900" href="{{ route('public.players.show', $player) }}">
                            <p class="font-medium">{{ $player->full_name }}</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">#{{ $player->jersey_number }} · {{ $player->position }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <aside class="space-y-6">
            <div class="card p-6">
                <h2 class="text-lg font-semibold">Matches</h2>
                <div class="mt-4 space-y-3">
                    @foreach($team->homeMatches->take(4) as $match)
                        <a class="block rounded-2xl border border-slate-200 p-4 hover:border-brand-400 dark:border-slate-800" href="{{ route('public.matches.show', $match) }}">
                            <p class="font-medium">vs {{ $match->awayTeam?->name }}</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $match->match_date?->format('d M Y') }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>
</div>
</body>
</html>