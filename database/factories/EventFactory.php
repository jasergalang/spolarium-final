<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;

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
            'title' => $this->faker->word(),
            'date' => $this->faker->randomNumber(3), // Assuming stock is a random number with 3 digits
            'time' => $this->faker->randomFloat(2, 10, 100), // Assuming price is a random float between 10 and 100 with 2 decimal places
            'description' => $this->faker->sentence(),
            'location' => $this->faker->sentence(),
            'category' => $this->faker->word(),



         
        ];
    }
}
