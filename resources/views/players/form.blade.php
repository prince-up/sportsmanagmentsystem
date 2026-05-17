@extends('layouts.app')

@section('page-title', $player->exists ? 'Edit Player' : 'Add Player')

@section('content')
    <x-section-heading :title="$player->exists ? 'Edit player' : 'Add player'" subtitle="Record jersey numbers, age bands, and stats in a consistent way."></x-section-heading>

    <div class="card p-6">
        <form method="POST" action="{{ $player->exists ? route('players.update', $player) : route('players.store') }}" class="grid gap-6 md:grid-cols-2">
            @csrf
            @if($player->exists)
                @method('PUT')
            @endif

            <div>
                <label class="label">Team</label>
                <select class="input" name="team_id">
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" @selected(old('team_id', $player->team_id) == $team->id)>{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="label">Season</label>
                <select class="input" name="season_id">
                    @foreach($seasons as $season)
                        <option value="{{ $season->id }}" @selected(old('season_id', $player->season_id) == $season->id)>{{ $season->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="label">Full Name</label>
                <input class="input" type="text" name="full_name" value="{{ old('full_name', $player->full_name) }}">
            </div>
            <div>
                <label class="label">Jersey Number</label>
                <input class="input" type="number" name="jersey_number" value="{{ old('jersey_number', $player->jersey_number) }}">
            </div>
            <div>
                <label class="label">Position</label>
                <input class="input" type="text" name="position" value="{{ old('position', $player->position) }}">
            </div>
            <div>
                <label class="label">Date of Birth</label>
                <input class="input" type="date" name="date_of_birth" value="{{ old('date_of_birth', optional($player->date_of_birth)->format('Y-m-d')) }}">
            </div>
            <div>
                <label class="label">Age</label>
                <input class="input" type="number" name="age" value="{{ old('age', $player->age) }}">
            </div>
            <div>
                <label class="label">Injury Status</label>
                <select class="input" name="injury_status">
                    @foreach(['fit','minor_injury','major_injury','recovering'] as $status)
                        <option value="{{ $status }}" @selected(old('injury_status', $player->injury_status) === $status)>{{ str_replace('_', ' ', $status) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="label">Rating</label>
                <input class="input" type="number" step="0.1" name="rating" value="{{ old('rating', $player->rating) }}">
            </div>
            <div>
                <label class="label">Market Value</label>
                <input class="input" type="number" step="0.01" name="market_value" value="{{ old('market_value', $player->market_value) }}">
            </div>
            <div class="md:col-span-2">
                <label class="label">Bio</label>
                <textarea class="input min-h-32" name="bio">{{ old('bio', $player->bio) }}</textarea>
            </div>
            <div class="md:col-span-2 flex gap-3">
                <button class="btn-primary" type="submit">{{ $player->exists ? 'Update player' : 'Save player' }}</button>
                <a class="btn-secondary" href="{{ route('players.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection