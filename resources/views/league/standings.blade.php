@extends('layouts.app')

@section('page-title', 'League Table')

@section('content')
    <x-section-heading title="League standings" subtitle="Auto-sorted by points, goal difference, goals scored, and fair play.">
        <x-slot name="actions">
            <a class="btn-primary" href="{{ route('league.standings.export') }}">Download PDF</a>
        </x-slot>
    </x-section-heading>

    <div class="card p-6">
        <div class="mb-4 flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500 dark:text-slate-400">Season</p>
                <p class="text-lg font-semibold text-slate-900 dark:text-white">{{ $season->name }}</p>
            </div>
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $standings->count() }} teams ranked</p>
        </div>

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
                        <th class="py-3 pl-4">Fair Play</th>
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
                            <td class="py-3 px-4 font-semibold">{{ $row['points'] }}</td>
                            <td class="py-3 pl-4">{{ $row['fair_play_points'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection