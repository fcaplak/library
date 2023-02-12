<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $categories = Category::all()->pluck('id')->toArray();
        $categoryId = $this->faker->randomElement($categories);

        $authors = Author::all()->pluck('id')->toArray();
        $authorId = $this->faker->randomElement($authors);

        return [
            'author_id' => $authorId,
            'category_id' => $categoryId,
            'name' => ucfirst(strtolower($this->faker->words(3, true))),
            'isbn' => $this->faker->isbn13(),
            'price' => $this->faker->randomFloat(2, 5, 30)
        ];
    }
}
