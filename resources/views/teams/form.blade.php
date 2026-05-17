@extends('layouts.app')

@section('page-title', $team->exists ? 'Edit Team' : 'Create Team')

@section('content')
    <x-section-heading :title="$team->exists ? 'Edit team' : 'Create team'" subtitle="Keep team registrations clean, traceable, and easy to maintain."></x-section-heading>

    <div class="card p-6">
        <form method="POST" action="{{ $team->exists ? route('teams.update', $team) : route('teams.store') }}" enctype="multipart/form-data" class="grid gap-6 md:grid-cols-2">
            @csrf
            @if($team->exists)
                @method('PUT')
            @endif

            <div>
                <label class="label">Season</label>
                <select class="input" name="season_id">
                    @foreach($seasons as $season)
                        <option value="{{ $season->id }}" @selected(old('season_id', $team->season_id) == $season->id)>{{ $season->name }}</option>
                    @endforeach
                </select>
                @error('season_id') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="label">Team Name</label>
                <input class="input" type="text" name="name" value="{{ old('name', $team->name) }}">
                @error('name') <p class="mt-1 text-sm text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="label">Coach</label>
                <input class="input" type="text" name="coach_name" value="{{ old('coach_name', $team->coach_name) }}">
            </div>
            <div>
                <label class="label">City</label>
                <input class="input" type="text" name="city" value="{{ old('city', $team->city) }}">
            </div>
            <div>
                <label class="label">Contact Email</label>
                <input class="input" type="email" name="contact_email" value="{{ old('contact_email', $team->contact_email) }}">
            </div>
            <div>
                <label class="label">Contact Phone</label>
                <input class="input" type="text" name="contact_phone" value="{{ old('contact_phone', $team->contact_phone) }}">
            </div>
            <div>
                <label class="label">Budget</label>
                <input class="input" type="number" step="0.01" name="budget" value="{{ old('budget', $team->budget) }}">
            </div>
            <div>
                <label class="label">Logo</label>
                <input class="input" type="file" name="logo">
            </div>
            <div class="md:col-span-2">
                <label class="label">Notes</label>
                <textarea class="input min-h-32" name="notes">{{ old('notes', $team->notes) }}</textarea>
            </div>
            <div class="md:col-span-2 flex gap-3">
                <button class="btn-primary" type="submit">{{ $team->exists ? 'Update team' : 'Create team' }}</button>
                <a class="btn-secondary" href="{{ route('teams.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection