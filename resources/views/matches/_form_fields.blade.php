<select class="input" name="season_id">
    @foreach($seasons as $season)
        <option value="{{ $season->id }}" @selected(old('season_id', $match->season_id ?? null) == $season->id)>{{ $season->name }}</option>
    @endforeach
</select>
<select class="input" name="venue_id">
    @foreach($venues as $venue)
        <option value="{{ $venue->id }}" @selected(old('venue_id', $match->venue_id ?? null) == $venue->id)>{{ $venue->name }}</option>
    @endforeach
</select>
<select class="input" name="home_team_id">
    @foreach($teams as $team)
        <option value="{{ $team->id }}" @selected(old('home_team_id', $match->home_team_id ?? null) == $team->id)>{{ $team->name }}</option>
    @endforeach
</select>
<select class="input" name="away_team_id">
    @foreach($teams as $team)
        <option value="{{ $team->id }}" @selected(old('away_team_id', $match->away_team_id ?? null) == $team->id)>{{ $team->name }}</option>
    @endforeach
</select>
<input class="input" type="datetime-local" name="match_date" value="{{ old('match_date', isset($match->match_date) ? $match->match_date->format('Y-m-d\TH:i') : '') }}">
<select class="input" name="status">
    @foreach(['scheduled','live','completed','cancelled'] as $status)
        <option value="{{ $status }}" @selected(old('status', $match->status ?? 'scheduled') === $status)>{{ ucfirst($status) }}</option>
    @endforeach
</select>