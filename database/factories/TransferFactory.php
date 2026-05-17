<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransferFactory extends Factory
{
    public function definition(): array
    {
        return [
            'player_id' => Player::factory(),
            'from_team_id' => Team::factory(),
            'to_team_id' => Team::factory(),
            'season_id' => Season::factory(),
            'transfer_date' => fake()->dateTimeBetween('-60 days', 'now')->format('Y-m-d'),
            'transfer_fee' => fake()->numberBetween(1000, 55000),
            'status' => fake()->randomElement(['rumored', 'offered', 'accepted', 'completed']),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}