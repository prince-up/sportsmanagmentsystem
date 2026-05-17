<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $player->full_name }} · Player Profile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-white">
<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
    <a class="btn-secondary mb-6 inline-flex" href="{{ route('public.teams.show', $player->team) }}">Back to team</a>

    <div class="grid gap-6 lg:grid-cols-[1fr_320px]">
        <section class="card p-6">
            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-brand-600">Public player profile</p>
            <h1 class="mt-3 text-3xl font-semibold">{{ $player->full_name }}</h1>
            <p class="mt-2 text-slate-500 dark:text-slate-400">{{ $player->team?->name }} · #{{ $player->jersey_number }} · {{ $player->position }}</p>

            <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <x-stat-card label="Age" :value="$player->age" tone="emerald" />
                <x-stat-card label="Goals" :value="$player->goals" tone="amber" />
                <x-stat-card label="Assists" :value="$player->assists" tone="sky" />
                <x-stat-card label="Rating" :value="$player->rating" tone="rose" />
            </div>

            <div class="mt-8">
                <h2 class="text-lg font-semibold">Recent injuries</h2>
                <div class="mt-4 space-y-3">
                    @forelse($player->injuries as $injury)
                        <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <p class="font-medium">{{ $injury->injury_type }}</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ ucfirst($injury->severity) }} · {{ $injury->recovery_progress }}%</p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">No injury history found.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <aside class="space-y-6">
            <div class="card p-6">
                <h2 class="text-lg font-semibold">Transfer history</h2>
                <div class="mt-4 space-y-3">
                    @forelse($player->transferHistory as $transfer)
                        <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <p class="font-medium">{{ $transfer->fromTeam?->name }} → {{ $transfer->toTeam?->name }}</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">${{ number_format((float) $transfer->transfer_fee, 2) }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">No transfers recorded.</p>
                    @endforelse
                </div>
            </div>
            <div class="card p-6">
                <h2 class="text-lg font-semibold">Season</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ $player->season?->name }}</p>
            </div>
        </aside>
    </div>
</div>
</body>
</html>