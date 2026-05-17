<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'player_id',
        'voted_by_user_id',
        'points',
        'reason',
    ];

    public function match(): BelongsTo
    {
        return $this->belongsTo(MatchModel::class, 'match_id');
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function voter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'voted_by_user_id');
    }
}