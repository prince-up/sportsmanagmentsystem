@extends('layouts.app')

@section('page-title', 'Matches')

@section('content')
    <x-section-heading title="Matches" subtitle="Schedule fixtures, update live scores, and keep match history organized."></x-section-heading>

    <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
        <div class="card p-6">
            <h2 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">Schedule match</h2>
            <form method="POST" action="{{ route('matches.store') }}" class="grid gap-4">
                @csrf
                <select class="input" name="season_id">
                    @foreach($seasons as $season)
                        <option value="{{ $season->id }}">{{ $season->name }}</option>
                    @endforeach
                </select>
                <select class="input" name="venue_id">
                    @foreach($venues as $venue)
                        <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                    @endforeach
                </select>
                <select class="input" name="home_team_id">
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
                <select class="input" name="away_team_id">
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
                <input class="input" type="datetime-local" name="match_date">
                <select class="input" name="status">
                    <option value="scheduled">Scheduled</option>
                    <option value="live">Live</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <button class="btn-primary" type="submit">Create match</button>
            </form>
        </div>

        <div class="card p-6">
            <form class="mb-6 flex gap-3" method="GET">
                <select class="input" name="status">
                    <option value="">All statuses</option>
                    @foreach(['scheduled','live','completed','cancelled'] as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                <button class="btn-secondary" type="submit">Filter</button>
            </form>

            <div class="space-y-4">
                @foreach($matches as $match)
                    @php($prediction = $predictions[$match->id])
                    <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $match->match_date?->format('d M, H:i') }}</p>
                                <p class="mt-1 font-medium text-slate-900 dark:text-white">{{ $match->homeTeam?->name }} vs {{ $match->awayTeam?->name }}</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $match->venue?->name ?? 'Venue pending' }} · {{ ucfirst($match->status) }}</p>
                            </div>
                            <div class="text-right text-sm">
                                <p class="font-semibold text-slate-900 dark:text-white">Prediction: {{ $prediction['winner'] }}</p>
                                <p class="text-slate-500 dark:text-slate-400"><span data-match-score="{{ $match->id }}">{{ $prediction['home_score'] }} - {{ $prediction['away_score'] }}</span> | {{ $prediction['confidence'] }}%</p>
                            </div>
                        </div>
                        @if($match->status === 'live' || $match->status === 'completed')
                            <p class="mt-3 text-sm font-medium text-brand-700 dark:text-brand-300">{{ $match->home_score }} - {{ $match->away_score }}</p>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-6">{{ $matches->links() }}</div>
        </div>
    </div>
@endsection