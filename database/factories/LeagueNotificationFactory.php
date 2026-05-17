<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeagueNotificationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(4),
            'message' => fake()->sentence(14),
            'type' => fake()->randomElement(['system', 'match', 'injury', 'transfer']),
            'metadata' => ['source' => 'seed'],
            'is_read' => fake()->boolean(35),
        ];
    }
}