<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => \App\Models\Customer::factory(), // Assuming customer_id references the id column in the customers table
            'total_amount' => $this->faker->randomFloat(2, 100, 1000), // Generate a random total amount
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipped', 'delivered']), // Random status from a predefined list
            // Add other fields as needed
        ];
    }
}
