<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VenueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'season_id' => ['nullable', 'exists:seasons,id'],
            'name' => ['required', 'string', 'max:150'],
            'city' => ['required', 'string', 'max:120'],
            'location' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'min:1'],
            'availability_status' => ['required', 'in:available,limited,closed'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }
}