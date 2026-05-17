<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class InjuryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'player_id' => Player::factory(),
            'team_id' => Team::factory(),
            'season_id' => Season::factory(),
            'injury_type' => fake()->randomElement(['Hamstring strain', 'Ankle sprain', 'Knee discomfort', 'Muscle fatigue']),
            'severity' => fake()->randomElement(['low', 'medium', 'high']),
            'started_at' => fake()->dateTimeBetween('-45 days', '-5 days')->format('Y-m-d'),
            'expected_return_at' => fake()->optional()->dateTimeBetween('now', '+30 days')?->format('Y-m-d'),
            'recovered_at' => null,
            'recovery_progress' => fake()->numberBetween(0, 90),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}