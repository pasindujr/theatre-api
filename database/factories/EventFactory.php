<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'venue_id' => \App\Models\Venue::inRandomOrder()->first()->id,
            'showtime_id' => \App\Models\Showtime::inRandomOrder()->first()->id,
            'day_id' => \App\Models\Day::inRandomOrder()->first()->id,
            'name' => $this->faker->name,
        ];
    }
}
