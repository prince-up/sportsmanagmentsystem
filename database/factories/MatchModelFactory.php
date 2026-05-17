<?php

namespace Database\Factories;

use App\Models\Season;
use App\Models\Team;
use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatchModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'season_id' => Season::factory(),
            'venue_id' => Venue::factory(),
            'home_team_id' => Team::factory(),
            'away_team_id' => Team::factory(),
            'mvp_player_id' => null,
            'match_date' => fake()->dateTimeBetween('-30 days', '+30 days'),
            'status' => fake()->randomElement(['scheduled', 'completed']),
            'live_status' => null,
            'home_score' => fake()->numberBetween(0, 5),
            'away_score' => fake()->numberBetween(0, 5),
            'highlights' => fake()->optional()->sentence(),
            'round_number' => fake()->numberBetween(1, 12),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}