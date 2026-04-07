<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'title' => fake()->sentence(),
            'author' => fake()->name(),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 50000, 150000),
            'stock' => fake()->numberBetween(1, 500),
            'cover' => fake()->imageUrl(200, 300, 'books', true),
        ];
    }
}
