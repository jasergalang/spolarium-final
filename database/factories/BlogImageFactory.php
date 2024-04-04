<?php

namespace Database\Factories;

use App\Models\BlogImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Blog; // Make sure to import the Blog model if it's not already imported

class BlogImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'blog_id' => Blog::factory(), // Assuming blog_id references the id column in the blogs table
            'image' => $this->faker->imageUrl(), // Generating a random image URL using faker
        ];
    }
}
