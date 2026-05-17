<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'team_id' => ['required', 'exists:teams,id'],
            'season_id' => ['required', 'exists:seasons,id'],
            'full_name' => ['required', 'string', 'max:150'],
            'jersey_number' => ['required', 'integer', 'min:1', 'max:99'],
            'position' => ['required', 'string', 'max:60'],
            'date_of_birth' => ['required', 'date'],
            'age' => ['required', 'integer', 'min:10', 'max:60'],
            'rating' => ['nullable', 'numeric', 'between:0,10'],
            'market_value' => ['nullable', 'numeric', 'min:0'],
            'injury_status' => ['required', 'in:fit,minor_injury,major_injury,recovering'],
            'bio' => ['nullable', 'string', 'max:1000'],
        ];
    }
}