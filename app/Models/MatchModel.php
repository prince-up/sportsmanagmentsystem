<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MatchModel extends Model
{
    use HasFactory;

    protected $table = 'matches';

    protected $fillable = [
        'season_id',
        'venue_id',
        'home_team_id',
        'away_team_id',
        'match_date',
        'status',
        'live_status',
        'home_score',
        'away_score',
        'highlights',
        'mvp_player_id',
        'round_number',
        'notes',
    ];

    protected $casts = [
        'match_date' => 'datetime',
        'home_score' => 'integer',
        'away_score' => 'integer',
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function mvpPlayer(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'mvp_player_id');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(PlayerVote::class, 'match_id');
    }
}