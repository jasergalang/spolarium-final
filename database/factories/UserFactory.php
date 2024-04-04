<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            // 'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Use bcrypt function to hash password
            'remember_token' => Str::random(10),
            
            'fname' => $this->faker->firstName(),
            'lname' => $this->faker->lastName(),
            'contact' => $this->faker->phoneNumber(),
            'roles' => 'user', // Assuming default role is 'user'
            'image_path' => $this->faker->imageUrl(), // Generating a random image URL using faker
            'status' => $this->faker->randomElement(['active', 'inactive']), // Random status from a predefined list
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
