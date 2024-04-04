<?php

namespace Database\Factories;

use App\Models\Artwork;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Artist; // Make sure to import the Artist model if it's not already imported

class ArtworkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Artwork::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'artist_id' => Artist::factory(), // Assuming artist_id references the id column in the artists table
            'name' => $this->faker->name(),
            'size' => $this->faker->numberBetween(1, 100), // Assuming size is a number between 1 and 100
            'desc' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 10, 1000), // Assuming price is a float number between 10 and 1000 with 2 decimal places
            'category' => $this->faker->word(), // Assuming category is a single word
            'status' => $this->faker->word(), // Assuming status is a single word
        ];
    }
}
