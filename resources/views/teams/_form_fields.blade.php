<div>
    <label class="label">Season</label>
    <select class="input" name="season_id">
        @foreach($seasons as $season)
            <option value="{{ $season->id }}" @selected(old('season_id', $team->season_id ?? null) == $season->id)>{{ $season->name }}</option>
        @endforeach
    </select>
</div>
<div>
    <label class="label">Team Name</label>
    <input class="input" type="text" name="name" value="{{ old('name', $team->name ?? '') }}">
</div>
<div>
    <label class="label">Coach</label>
    <input class="input" type="text" name="coach_name" value="{{ old('coach_name', $team->coach_name ?? '') }}">
</div>
<div>
    <label class="label">City</label>
    <input class="input" type="text" name="city" value="{{ old('city', $team->city ?? '') }}">
</div>
<div>
    <label class="label">Contact Email</label>
    <input class="input" type="email" name="contact_email" value="{{ old('contact_email', $team->contact_email ?? '') }}">
</div>
<div>
    <label class="label">Contact Phone</label>
    <input class="input" type="text" name="contact_phone" value="{{ old('contact_phone', $team->contact_phone ?? '') }}">
</div>
<div>
    <label class="label">Budget</label>
    <input class="input" type="number" step="0.01" name="budget" value="{{ old('budget', $team->budget ?? '') }}">
</div>
<div>
    <label class="label">Logo</label>
    <input class="input" type="file" name="logo">
</div>
<div class="md:col-span-2">
    <label class="label">Notes</label>
    <textarea class="input min-h-32" name="notes">{{ old('notes', $team->notes ?? '') }}</textarea>
</div>