@extends('layouts.app')

@section('page-title', 'Teams')

@section('content')
    <x-section-heading title="Teams" subtitle="Register and maintain club profiles, budgets, and contacts.">
        <x-slot name="actions">
            <a class="btn-primary" href="{{ route('teams.create') }}">Create team</a>
        </x-slot>
    </x-section-heading>

    <div class="card p-6">
        <form class="mb-6 grid gap-4 md:grid-cols-[1fr_auto]" method="GET">
            <input class="input" type="search" name="search" value="{{ request('search') }}" placeholder="Search teams, city, coach...">
            <button class="btn-secondary" type="submit">Search</button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                <thead class="text-left text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="py-3 pr-4">Team</th>
                        <th class="py-3 px-4">Coach</th>
                        <th class="py-3 px-4">City</th>
                        <th class="py-3 px-4">Budget</th>
                        <th class="py-3 px-4">Players</th>
                        <th class="py-3 px-4">QR</th>
                        <th class="py-3 pl-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach($teams as $team)
                        <tr>
                            <td class="py-3 pr-4 font-medium text-slate-900 dark:text-white">
                                <a class="hover:text-brand-600" href="{{ route('teams.show', $team) }}">{{ $team->name }}</a>
                            </td>
                            <td class="py-3 px-4">{{ $team->coach_name }}</td>
                            <td class="py-3 px-4">{{ $team->city }}</td>
                            <td class="py-3 px-4">${{ number_format((float) $team->budget, 2) }}</td>
                            <td class="py-3 px-4">{{ $team->players->count() }}</td>
                            <td class="py-3 px-4"><a class="text-brand-700 underline" href="{{ route('teams.qr', $team) }}" target="_blank">View</a></td>
                            <td class="py-3 pl-4">
                                <div class="flex items-center gap-3">
                                    <a class="text-slate-600 hover:text-brand-700 dark:text-slate-300" href="{{ route('teams.edit', $team) }}">Edit</a>
                                    <form method="POST" action="{{ route('teams.destroy', $team) }}" onsubmit="return confirm('Delete this team?')">
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

        <div class="mt-6">{{ $teams->links() }}</div>
    </div>
@endsection