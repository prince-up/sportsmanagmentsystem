<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $match->homeTeam?->name }} vs {{ $match->awayTeam?->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-white">
<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
    <a class="btn-secondary mb-6 inline-flex" href="/">Back to home</a>

    <section class="card p-6">
        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-brand-600">Public match detail</p>
        <h1 class="mt-3 text-3xl font-semibold">{{ $match->homeTeam?->name }} vs {{ $match->awayTeam?->name }}</h1>
        <p class="mt-2 text-slate-500 dark:text-slate-400">{{ $match->venue?->name ?? 'Venue pending' }} · {{ $match->match_date?->format('d M Y, H:i') }}</p>

        <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <x-stat-card label="Status" :value="ucfirst($match->status)" tone="emerald" />
            <x-stat-card label="Score" :value="$match->home_score.' - '.$match->away_score" tone="amber" />
            <x-stat-card label="MVP" :value="$match->mvpPlayer?->full_name ?? 'Pending'" tone="sky" />
            <x-stat-card label="Round" :value="$match->round_number ?? '—'" tone="rose" />
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-2">
            <div>
                <h2 class="text-lg font-semibold">Highlights</h2>
                <p class="mt-3 text-sm leading-7 text-slate-600 dark:text-slate-300">{{ $match->highlights ?: 'No highlights have been added yet.' }}</p>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Voting</h2>
                <div class="mt-4 space-y-3">
                    @forelse($match->votes as $vote)
                        <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <p class="font-medium">{{ $vote->player?->full_name }}</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $vote->points }} points</p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">No votes yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>