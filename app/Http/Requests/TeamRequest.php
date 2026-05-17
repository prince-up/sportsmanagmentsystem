<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'season_id' => ['required', 'exists:seasons,id'],
            'name' => ['required', 'string', 'max:120'],
            'coach_name' => ['required', 'string', 'max:120'],
            'city' => ['required', 'string', 'max:120'],
            'contact_email' => ['nullable', 'email', 'max:150'],
            'contact_phone' => ['nullable', 'string', 'max:30'],
            'budget' => ['required', 'numeric', 'min:0'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }
}