<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SeasonFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-6 months', '-3 months');

        return [
            'name' => fake()->unique()->randomElement(['Spring Cup', 'Summer League', 'Autumn Championship', 'Winter Trophy']) . ' ' . fake()->year(),
            'starts_on' => $start->format('Y-m-d'),
            'ends_on' => fake()->dateTimeBetween($start, '+6 months')->format('Y-m-d'),
            'is_active' => false,
            'archived_at' => null,
        ];
    }

    public function active(): static
    {
        return $this->state(fn () => ['is_active' => true]);
    }
}