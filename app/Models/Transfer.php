<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'from_team_id',
        'to_team_id',
        'season_id',
        'transfer_date',
        'transfer_fee',
        'status',
        'notes',
    ];

    protected $casts = [
        'transfer_date' => 'date',
        'transfer_fee' => 'decimal:2',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function fromTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'from_team_id');
    }

    public function toTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'to_team_id');
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }
}