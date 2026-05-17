@extends('layouts.app')

@section('page-title', 'Injuries')

@section('content')
    <x-section-heading title="Injury recovery" subtitle="Track fitness status and expected return dates across the squad."></x-section-heading>

    <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
        <div class="card p-6">
            <h2 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">Log injury</h2>
            <form method="POST" action="{{ route('injuries.store') }}" class="grid gap-4">
                @csrf
                <input class="input" type="number" name="player_id" placeholder="Player ID">
                <input class="input" type="number" name="team_id" placeholder="Team ID">
                <input class="input" type="number" name="season_id" placeholder="Season ID">
                <input class="input" type="text" name="injury_type" placeholder="Injury type">
                <select class="input" name="severity">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                    <option value="critical">Critical</option>
                </select>
                <input class="input" type="date" name="started_at">
                <input class="input" type="date" name="expected_return_at">
                <input class="input" type="number" name="recovery_progress" min="0" max="100" placeholder="Recovery progress">
                <textarea class="input min-h-28" name="notes" placeholder="Notes"></textarea>
                <button class="btn-primary" type="submit">Save injury</button>
            </form>
        </div>

        <div class="card p-6">
            <div class="space-y-4">
                @foreach($injuries as $injury)
                    <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="font-medium text-slate-900 dark:text-white">{{ $injury->player?->full_name }}</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $injury->injury_type }} · {{ ucfirst($injury->severity) }}</p>
                            </div>
                            <span class="rounded-full bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700 dark:bg-rose-500/10 dark:text-rose-300">{{ $injury->recovery_progress }}%</span>
                        </div>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Return: {{ $injury->expected_return_at?->format('d M Y') ?? 'TBA' }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">{{ $injuries->links() }}</div>
        </div>
    </div>
@endsection