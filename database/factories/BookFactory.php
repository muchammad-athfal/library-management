<?php

namespace Database\Factories;

use App\Models\Author;
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
    public function definition(): array
    {
        $author = Author::factory()->create();
        return [
            'title' => fake()->sentence(),
            'description' => fake()->sentence(),
            'publish_date' => fake()->date(),
            'author_id' => $author->id,
        ];
    }
}
