<?php

namespace Database\Factories;

use App\Models\Season;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TeamFactory extends Factory
{
    public function definition(): array
    {
        $city = fake()->city();
        $name = fake()->unique()->company() . ' FC';

        return [
            'season_id' => Season::factory(),
            'created_by' => User::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'logo_path' => null,
            'coach_name' => fake()->name(),
            'city' => $city,
            'contact_email' => fake()->safeEmail(),
            'contact_phone' => fake()->phoneNumber(),
            'budget' => fake()->numberBetween(50000, 250000),
            'spent_budget' => fake()->numberBetween(15000, 120000),
            'fair_play_points' => fake()->numberBetween(2, 20),
            'qr_code' => null,
            'is_active' => true,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}