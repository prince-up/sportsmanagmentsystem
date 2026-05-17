<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Injury extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'team_id',
        'season_id',
        'injury_type',
        'severity',
        'started_at',
        'expected_return_at',
        'recovered_at',
        'recovery_progress',
        'notes',
    ];

    protected $casts = [
        'started_at' => 'date',
        'expected_return_at' => 'date',
        'recovered_at' => 'date',
        'recovery_progress' => 'integer',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}