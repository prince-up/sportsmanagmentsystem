<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'player_id' => ['required', 'exists:players,id'],
            'from_team_id' => ['required', 'exists:teams,id'],
            'to_team_id' => ['required', 'different:from_team_id', 'exists:teams,id'],
            'season_id' => ['required', 'exists:seasons,id'],
            'transfer_date' => ['required', 'date'],
            'transfer_fee' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:rumored,offered,accepted,rejected,completed'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }
}