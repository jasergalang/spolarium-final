<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Import the Str class for generating UUIDs

class FailedJobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Illuminate\Queue\Failed\FailedJob::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => (string) Str::uuid(), // Generate a UUID
            'connection' => $this->faker->word(),
            'queue' => $this->faker->word(),
            'payload' => $this->faker->paragraph(),
        ];
    }
}
