@extends('layouts.app')

@section('page-title', 'Transfers')

@section('content')
    <x-section-heading title="Transfer market" subtitle="Monitor player movement, fees, and transaction status."></x-section-heading>

    <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
        <div class="card p-6">
            <h2 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">Log transfer</h2>
            <form method="POST" action="{{ route('transfers.store') }}" class="grid gap-4">
                @csrf
                <input class="input" type="number" name="player_id" placeholder="Player ID">
                <input class="input" type="number" name="from_team_id" placeholder="From Team ID">
                <input class="input" type="number" name="to_team_id" placeholder="To Team ID">
                <input class="input" type="number" name="season_id" placeholder="Season ID">
                <input class="input" type="date" name="transfer_date">
                <input class="input" type="number" step="0.01" name="transfer_fee" placeholder="Transfer fee">
                <select class="input" name="status">
                    <option value="rumored">Rumored</option>
                    <option value="offered">Offered</option>
                    <option value="accepted">Accepted</option>
                    <option value="rejected">Rejected</option>
                    <option value="completed">Completed</option>
                </select>
                <textarea class="input min-h-28" name="notes" placeholder="Notes"></textarea>
                <button class="btn-primary" type="submit">Save transfer</button>
            </form>
        </div>

        <div class="card p-6">
            <div class="space-y-4">
                @foreach($transfers as $transfer)
                    <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="font-medium text-slate-900 dark:text-white">{{ $transfer->player?->full_name }}</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $transfer->fromTeam?->name }} → {{ $transfer->toTeam?->name }}</p>
                            </div>
                            <span class="text-sm font-semibold text-brand-700 dark:text-brand-300">${{ number_format((float) $transfer->transfer_fee, 2) }}</span>
                        </div>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ ucfirst($transfer->status) }} · {{ $transfer->transfer_date?->format('d M Y') }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">{{ $transfers->links() }}</div>
        </div>
    </div>
@endsection