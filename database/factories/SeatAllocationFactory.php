<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeatAllocation>
 */
class SeatAllocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => \App\Models\Event::inRandomOrder()->first()->id,
            'seat_number' => $this->faker->numberBetween(1, 300),
            'is_reserved' => $this->faker->boolean(),
        ];
    }
}
