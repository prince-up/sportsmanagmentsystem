@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')
    <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-slate-950 text-white shadow-2xl dark:border-slate-800">
        <div class="bg-[radial-gradient(circle_at_top_right,_rgba(34,197,94,0.24),_transparent_35%),linear-gradient(135deg,_#0f172a,_#111827_45%,_#020617)] px-6 py-7 sm:px-8">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-3xl">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-brand-300">Season dashboard</p>
                    <h1 class="mt-3 text-4xl font-semibold tracking-tight sm:text-5xl">{{ $season->name }}</h1>
                    <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-300 sm:text-base">A live operational view for league admins. Follow the table, open fixtures, injury recovery, transfers, and recent broadcast events from one screen.</p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a class="btn-secondary bg-white text-slate-900 hover:bg-slate-100" href="{{ route('league.standings.export') }}">Export standings</a>
                    <a class="btn-primary" href="{{ route('matches.index') }}">Manage matches</a>
                </div>
            </div>

            <div class="mt-6 grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                    <p class="text-sm text-slate-400">League leader</p>
                    <p class="mt-2 text-lg font-semibold">{{ $leader['team_name'] ?? 'Not available' }}</p>
                    <p class="mt-1 text-sm text-slate-300">{{ $leader['points'] ?? 0 }} points</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                    <p class="text-sm text-slate-400">Best attack</p>
                    <p class="mt-2 text-lg font-semibold">{{ $topAttack['team_name'] ?? 'Not available' }}</p>
                    <p class="mt-1 text-sm text-slate-300">{{ $topAttack['goals_for'] ?? 0 }} goals scored</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                    <p class="text-sm text-slate-400">Best defense</p>
                    <p class="mt-2 text-lg font-semibold">{{ $bestDefense['team_name'] ?? 'Not available' }}</p>
                    <p class="mt-1 text-sm text-slate-300">{{ $bestDefense['goals_against'] ?? 0 }} goals conceded</p>
                </div>
                <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                    <p class="text-sm text-slate-400">Active venues</p>
                    <p class="mt-2 text-lg font-semibold">{{ $totalVenues }}</p>
                    <p class="mt-1 text-sm text-slate-300">{{ $totalPlayers }} registered players</p>
                </div>
            </div>
        </div>

        <div class="grid gap-4 border-t border-white/10 bg-white/5 px-6 py-5 sm:grid-cols-2 xl:grid-cols-5">
            <x-stat-card label="Completed matches" :value="$completedMatches" hint="Season results already closed" tone="emerald">Final</x-stat-card>
            <x-stat-card label="Scheduled matches" :value="$scheduledMatches" hint="Fixtures waiting for kickoff" tone="sky">Queue</x-stat-card>
            <x-stat-card label="Live matches" :value="$liveMatches" hint="Currently updating in real time" tone="amber">Now</x-stat-card>
            <x-stat-card label="Injured players" :value="$injuredPlayers->count()" hint="Fitness and recovery tracking" tone="rose">Care</x-stat-card>
            <x-stat-card label="Recent transfers" :value="$recentTransfers->count()" hint="Transfer market activity" tone="violet">Market</x-stat-card>
        </div>
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-[1.35fr_0.65fr]">
        <section class="space-y-6">
            <div class="card p-6">
                <x-section-heading title="League table snapshot" subtitle="Auto-sorted by points, goal difference, and goals scored.">
                    <x-slot name="actions">
                        <a class="btn-secondary" href="{{ route('league.standings') }}">Open full table</a>
                    </x-slot>
                </x-section-heading>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-left text-sm dark:divide-slate-800">
                        <thead class="text-slate-500 dark:text-slate-400">
                            <tr>
                                <th class="py-3 pr-4">#</th>
                                <th class="py-3 px-4">Team</th>
                                <th class="py-3 px-4">P</th>
                                <th class="py-3 px-4">W</th>
                                <th class="py-3 px-4">D</th>
                                <th class="py-3 px-4">L</th>
                                <th class="py-3 px-4">GF</th>
                                <th class="py-3 px-4">GA</th>
                                <th class="py-3 px-4">GD</th>
                                <th class="py-3 px-4">Pts</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @foreach($standings as $row)
                                <tr>
                                    <td class="py-3 pr-4 font-semibold text-brand-700 dark:text-brand-300">{{ $loop->iteration }}</td>
                                    <td class="py-3 px-4 font-medium text-slate-900 dark:text-white">{{ $row['team_name'] }}</td>
                                    <td class="py-3 px-4">{{ $row['played'] }}</td>
                                    <td class="py-3 px-4">{{ $row['wins'] }}</td>
                                    <td class="py-3 px-4">{{ $row['draws'] }}</td>
                                    <td class="py-3 px-4">{{ $row['losses'] }}</td>
                                    <td class="py-3 px-4">{{ $row['goals_for'] }}</td>
                                    <td class="py-3 px-4">{{ $row['goals_against'] }}</td>
                                    <td class="py-3 px-4">{{ $row['goal_difference'] }}</td>
                                    <td class="py-3 px-4 font-semibold text-brand-700 dark:text-brand-300">{{ $row['points'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="card p-6">
                    <x-section-heading title="Form guide" subtitle="A quick visual of the strongest teams right now."></x-section-heading>
                    <div class="space-y-4">
                        @foreach($table->take(5) as $row)
                            <div>
                                <div class="mb-2 flex items-center justify-between text-sm">
                                    <span class="font-medium text-slate-900 dark:text-white">{{ $row['team_name'] }}</span>
                                    <span class="text-slate-500 dark:text-slate-400">{{ $row['points'] }} pts</span>
                                </div>
                                <div class="h-2 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800">
                                    <div class="h-full rounded-full bg-gradient-to-r from-brand-500 to-emerald-400" style="width: {{ max(18, min(100, $leader['points'] > 0 ? ($row['points'] / $leader['points']) * 100 : 0)) }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card p-6">
                    <x-section-heading title="Recent completed matches" subtitle="Fast recap of the latest results."></x-section-heading>
                    <div class="space-y-3">
                        @forelse($recentMatches as $match)
                            <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <p class="font-medium text-slate-900 dark:text-white">{{ $match->homeTeam?->name }} vs {{ $match->awayTeam?->name }}</p>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $match->venue?->name ?? 'Venue pending' }} · {{ $match->match_date?->format('d M') }}</p>
                                    </div>
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-800 dark:bg-slate-800 dark:text-slate-200">{{ $match->home_score }} - {{ $match->away_score }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500 dark:text-slate-400">No completed matches yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <section class="space-y-6">
            <div class="card p-6">
                <x-section-heading title="Live updates"></x-section-heading>
                <div id="live-feed" class="space-y-3">
                    <p class="text-sm text-slate-500 dark:text-slate-400">Waiting for live match events...</p>
                </div>
            </div>

            <div class="card p-6">
                <x-section-heading title="Notifications"></x-section-heading>
                <div id="notification-feed" class="space-y-3">
                    @forelse($notifications as $notification)
                        <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <p class="font-medium text-slate-900 dark:text-white">{{ $notification->title }}</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $notification->message }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">No notifications yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="card p-6">
                <x-section-heading title="Upcoming matches"></x-section-heading>
                <div class="space-y-4">
                    @forelse($upcomingMatches as $match)
                        <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $match->match_date?->format('d M, H:i') }}</p>
                            <p class="mt-1 font-medium text-slate-900 dark:text-white">{{ $match->homeTeam?->name }} vs {{ $match->awayTeam?->name }}</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $match->venue?->name ?? 'Venue pending' }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">No upcoming fixtures yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="card p-6">
                <x-section-heading title="Recent transfers"></x-section-heading>
                <div class="space-y-4">
                    @forelse($recentTransfers as $transfer)
                        <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <p class="font-medium text-slate-900 dark:text-white">{{ $transfer->player?->full_name }}</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $transfer->fromTeam?->name }} → {{ $transfer->toTeam?->name }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">No recent transfers.</p>
                    @endforelse
                </div>
            </div>

            <div class="card p-6">
                <x-section-heading title="Injured players"></x-section-heading>
                <div class="space-y-4">
                    @forelse($injuredPlayers as $injury)
                        <div class="flex items-center justify-between rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                            <div>
                                <p class="font-medium text-slate-900 dark:text-white">{{ $injury->player?->full_name }}</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $injury->injury_type }}</p>
                            </div>
                            <span class="rounded-full bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700 dark:bg-rose-500/10 dark:text-rose-300">{{ $injury->recovery_progress }}%</span>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">No active injuries.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection