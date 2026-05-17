<?php

namespace Database\Factories;

use App\Models\Season;
use Illuminate\Database\Eloquent\Factories\Factory;

class VenueFactory extends Factory
{
    public function definition(): array
    {
        return [
            'season_id' => Season::factory(),
            'name' => fake()->company() . ' Ground',
            'city' => fake()->city(),
            'location' => fake()->streetAddress(),
            'capacity' => fake()->numberBetween(1500, 25000),
            'availability_status' => fake()->randomElement(['available', 'limited']),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}