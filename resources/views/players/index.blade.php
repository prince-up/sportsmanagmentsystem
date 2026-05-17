@extends('layouts.app')

@section('page-title', 'Players')

@section('content')
    <div x-data="{ open: false }">
        <x-section-heading title="Players" subtitle="Manage squad lists, jersey numbers, performance data, and injuries.">
            <x-slot name="actions">
                <button class="btn-primary" type="button" @click="open = true">Add player</button>
            </x-slot>
        </x-section-heading>

        <x-modal id="player-create-modal" title="Add player">
            <form method="POST" action="{{ route('players.store') }}" class="grid gap-6 md:grid-cols-2">
                @csrf
                @include('players._form_fields', ['player' => new \App\Models\Player(), 'teams' => $teams, 'seasons' => $seasons])
                <div class="md:col-span-2 flex gap-3">
                    <button class="btn-primary" type="submit">Save player</button>
                    <button class="btn-secondary" type="button" @click="open = false">Cancel</button>
                </div>
            </form>
        </x-modal>

        <div class="card p-6">
            <form class="mb-6 grid gap-4 lg:grid-cols-[1fr_220px_auto]" method="GET">
                <input class="input" type="search" name="search" value="{{ request('search') }}" placeholder="Search players or positions...">
                <select class="input" name="team_id">
                    <option value="">All teams</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" @selected(request('team_id') == $team->id)>{{ $team->name }}</option>
                    @endforeach
                </select>
                <button class="btn-secondary" type="submit">Filter</button>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                    <thead class="text-left text-slate-500 dark:text-slate-400">
                        <tr>
                            <th class="py-3 pr-4">Player</th>
                            <th class="py-3 px-4">Team</th>
                            <th class="py-3 px-4">Pos</th>
                            <th class="py-3 px-4">Age</th>
                            <th class="py-3 px-4">Rating</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 pl-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach($players as $player)
                            <tr>
                                <td class="py-3 pr-4 font-medium text-slate-900 dark:text-white">{{ $player->full_name }}</td>
                                <td class="py-3 px-4">{{ $player->team?->name }}</td>
                                <td class="py-3 px-4">#{{ $player->jersey_number }} · {{ $player->position }}</td>
                                <td class="py-3 px-4">{{ $player->age }}</td>
                                <td class="py-3 px-4">{{ $player->rating }}</td>
                                <td class="py-3 px-4">{{ str_replace('_', ' ', $player->injury_status) }}</td>
                                <td class="py-3 pl-4">
                                    <div class="flex items-center gap-3">
                                        <a class="text-slate-600 hover:text-brand-700 dark:text-slate-300" href="{{ route('players.edit', $player) }}">Edit</a>
                                        <form method="POST" action="{{ route('players.destroy', $player) }}" onsubmit="return confirm('Delete this player?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-rose-600 hover:text-rose-700" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">{{ $players->links() }}</div>
        </div>
    </div>
@endsection