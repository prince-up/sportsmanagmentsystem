@extends('layouts.app')

@section('page-title', 'Seasons')

@section('content')
    <x-section-heading title="Seasons" subtitle="Create, activate, and archive multiple league seasons."></x-section-heading>

    <div class="grid gap-6 xl:grid-cols-[0.8fr_1.2fr]">
        <div class="card p-6">
            <h2 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">New season</h2>
            <form method="POST" action="{{ route('seasons.store') }}" class="grid gap-4">
                @csrf
                <input class="input" type="text" name="name" placeholder="Season name">
                <input class="input" type="date" name="starts_on">
                <input class="input" type="date" name="ends_on">
                <label class="flex items-center gap-3 text-sm text-slate-700 dark:text-slate-300">
                    <input type="checkbox" name="is_active" value="1" class="rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                    Set as active season
                </label>
                <button class="btn-primary" type="submit">Create season</button>
            </form>
        </div>

        <div class="card p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                    <thead class="text-left text-slate-500 dark:text-slate-400">
                        <tr>
                            <th class="py-3 pr-4">Season</th>
                            <th class="py-3 px-4">Dates</th>
                            <th class="py-3 px-4">Active</th>
                            <th class="py-3 pl-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach($seasons as $season)
                            <tr>
                                <td class="py-3 pr-4 font-medium text-slate-900 dark:text-white">{{ $season->name }}</td>
                                <td class="py-3 px-4">{{ $season->starts_on?->format('d M Y') }} - {{ $season->ends_on?->format('d M Y') }}</td>
                                <td class="py-3 px-4">{{ $season->is_active ? 'Yes' : 'No' }}</td>
                                <td class="py-3 pl-4">
                                    <form method="POST" action="{{ route('seasons.archive', $season) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="text-slate-600 hover:text-brand-700 dark:text-slate-300" type="submit">Archive</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">{{ $seasons->links() }}</div>
        </div>
    </div>
@endsection