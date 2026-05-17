<?php

namespace Database\Factories;

use App\Models\MatchModel;
use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerVoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'match_id' => MatchModel::factory(),
            'player_id' => Player::factory(),
            'voted_by_user_id' => User::factory(),
            'points' => fake()->numberBetween(1, 5),
            'reason' => fake()->sentence(),
        ];
    }
}