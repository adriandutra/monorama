<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'source' => fake()->sentence(),
            'owner' => fake()->randomElement([1, 2, 3, 4, 5, 6]),
            'created_at' => fake()->dateTime($max = 'now', $timezone = null),
            'created_by' => fake()->randomElement([1, 2, 3, 4, 5, 6])
        ];
    }
}
