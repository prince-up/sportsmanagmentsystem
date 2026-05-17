<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'season_id',
        'full_name',
        'slug',
        'jersey_number',
        'position',
        'date_of_birth',
        'age',
        'goals',
        'assists',
        'appearances',
        'yellow_cards',
        'red_cards',
        'rating',
        'injury_status',
        'is_captain',
        'market_value',
        'bio',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_captain' => 'boolean',
        'market_value' => 'decimal:2',
        'rating' => 'decimal:1',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function injuries(): HasMany
    {
        return $this->hasMany(Injury::class);
    }

    public function transferHistory(): HasMany
    {
        return $this->hasMany(Transfer::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(PlayerVote::class);
    }
}