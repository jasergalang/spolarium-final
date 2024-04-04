<?php

namespace Database\Factories;

use App\Models\MaterialImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MaterialImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'material_id' => Material::factory(), // Assuming material_id references the id column in the materials table
            'image_path' => $this->faker->imageUrl(), // Generating a random image URL using faker
        ];
    }
}
