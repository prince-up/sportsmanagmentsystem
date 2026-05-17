@extends('layouts.app')

@section('page-title', 'Venues')

@section('content')
    <x-section-heading title="Venues" subtitle="Track capacity, location, and availability for match scheduling."></x-section-heading>

    <div class="grid gap-6 xl:grid-cols-[0.8fr_1.2fr]">
        <div class="card p-6">
            <h2 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">Add venue</h2>
            <form method="POST" action="{{ route('venues.store') }}" class="grid gap-4">
                @csrf
                <input class="input" type="text" name="name" placeholder="Venue name">
                <input class="input" type="text" name="city" placeholder="City">
                <input class="input" type="text" name="location" placeholder="Location">
                <input class="input" type="number" name="capacity" placeholder="Capacity">
                <select class="input" name="availability_status">
                    <option value="available">Available</option>
                    <option value="limited">Limited</option>
                    <option value="closed">Closed</option>
                </select>
                <textarea class="input min-h-28" name="notes" placeholder="Notes"></textarea>
                <button class="btn-primary" type="submit">Save venue</button>
            </form>
        </div>

        <div class="card p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                    <thead class="text-left text-slate-500 dark:text-slate-400">
                        <tr>
                            <th class="py-3 pr-4">Venue</th>
                            <th class="py-3 px-4">City</th>
                            <th class="py-3 px-4">Capacity</th>
                            <th class="py-3 px-4">Availability</th>
                            <th class="py-3 pl-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach($venues as $venue)
                            <tr>
                                <td class="py-3 pr-4 font-medium text-slate-900 dark:text-white">{{ $venue->name }}</td>
                                <td class="py-3 px-4">{{ $venue->city }}</td>
                                <td class="py-3 px-4">{{ number_format($venue->capacity) }}</td>
                                <td class="py-3 px-4">{{ ucfirst($venue->availability_status) }}</td>
                                <td class="py-3 pl-4">
                                    <form method="POST" action="{{ route('venues.destroy', $venue) }}" onsubmit="return confirm('Delete this venue?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-rose-600 hover:text-rose-700" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">{{ $venues->links() }}</div>
        </div>
    </div>
@endsection