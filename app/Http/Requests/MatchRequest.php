<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'season_id' => ['required', 'exists:seasons,id'],
            'venue_id' => ['required', 'exists:venues,id'],
            'home_team_id' => ['required', 'different:away_team_id', 'exists:teams,id'],
            'away_team_id' => ['required', 'exists:teams,id'],
            'match_date' => ['required', 'date'],
            'status' => ['required', 'in:scheduled,live,completed,cancelled'],
            'home_score' => ['nullable', 'integer', 'min:0'],
            'away_score' => ['nullable', 'integer', 'min:0'],
            'highlights' => ['nullable', 'string', 'max:2000'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }
}