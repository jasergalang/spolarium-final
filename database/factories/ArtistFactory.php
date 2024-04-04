<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArtistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Artist::class;

    /**
     * Define the model's default state.s
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->unique()->numberBetween(1, 100), // Assuming user_id references the id column in the users table
            // Add other fields as needed
        ];
    }
}
