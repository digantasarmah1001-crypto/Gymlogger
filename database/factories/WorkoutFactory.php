<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Workout>
 */
class WorkoutFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->randomElement(['Push day', 'Pull day', 'Leg day', 'Upper body', 'Full body']),
            'date' => fake()->dateTimeBetween('-2 months', 'now'),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
