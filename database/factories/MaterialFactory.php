<?php

namespace Database\Factories;

use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Material::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'stock' => $this->faker->randomNumber(3), // Assuming stock is a random number with 3 digits
            'price' => $this->faker->randomFloat(2, 10, 100), // Assuming price is a random float between 10 and 100 with 2 decimal places
            'desc' => $this->faker->sentence(),
            'category' => $this->faker->word(),
        ];
    }
}
