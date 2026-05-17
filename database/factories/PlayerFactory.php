<?php

namespace Database\Factories;

use App\Models\Season;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlayerFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->name();

        return [
            'season_id' => Season::factory(),
            'team_id' => Team::factory(),
            'full_name' => $name,
            'slug' => Str::slug($name),
            'jersey_number' => fake()->unique()->numberBetween(1, 99),
            'position' => fake()->randomElement(['Goalkeeper', 'Defender', 'Midfielder', 'Forward']),
            'date_of_birth' => fake()->dateTimeBetween('-35 years', '-18 years')->format('Y-m-d'),
            'age' => fake()->numberBetween(18, 35),
            'goals' => fake()->numberBetween(0, 18),
            'assists' => fake()->numberBetween(0, 16),
            'appearances' => fake()->numberBetween(2, 28),
            'yellow_cards' => fake()->numberBetween(0, 7),
            'red_cards' => fake()->numberBetween(0, 2),
            'rating' => fake()->randomFloat(1, 5.8, 9.8),
            'injury_status' => fake()->randomElement(['fit', 'minor_injury', 'major_injury', 'recovering']),
            'is_captain' => false,
            'market_value' => fake()->numberBetween(5000, 80000),
            'bio' => fake()->optional()->paragraph(),
        ];
    }
}