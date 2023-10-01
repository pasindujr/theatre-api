<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Showtime>
 */
class ShowtimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // random time sets the time to a random time between 00:00:00 and 23:59:59
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
        ];
    }
}
