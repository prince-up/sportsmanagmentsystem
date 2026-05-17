<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InjuryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'player_id' => ['required', 'exists:players,id'],
            'team_id' => ['required', 'exists:teams,id'],
            'season_id' => ['required', 'exists:seasons,id'],
            'injury_type' => ['required', 'string', 'max:120'],
            'severity' => ['required', 'in:low,medium,high,critical'],
            'started_at' => ['required', 'date'],
            'expected_return_at' => ['nullable', 'date'],
            'recovery_progress' => ['nullable', 'integer', 'min:0', 'max:100'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }
}