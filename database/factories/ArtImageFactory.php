<?php

namespace Database\Factories;

use App\Models\ArtImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Artist; // Make sure to import the Artist model if it's not already imported

class ArtImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ArtImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'artist_id' => Artist::factory(), // Assuming artist_id references the id column in the artists table
            'image_path' => $this->faker->imageUrl(), // Generating a random image URL using faker
        ];
    }
}
