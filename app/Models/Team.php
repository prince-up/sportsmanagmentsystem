<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_id',
        'created_by',
        'name',
        'slug',
        'logo_path',
        'coach_name',
        'city',
        'contact_email',
        'contact_phone',
        'budget',
        'spent_budget',
        'fair_play_points',
        'qr_code',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'budget' => 'decimal:2',
        'spent_budget' => 'decimal:2',
        'fair_play_points' => 'integer',
        'is_active' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }

    public function homeMatches(): HasMany
    {
        return $this->hasMany(MatchModel::class, 'home_team_id');
    }

    public function awayMatches(): HasMany
    {
        return $this->hasMany(MatchModel::class, 'away_team_id');
    }

    public function transfers(): HasMany
    {
        return $this->hasMany(Transfer::class);
    }
}