<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(5, true);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => fake()->paragraph(5),
            'category_id' => rand(1, 3),
            'user_id' => rand(1, 3)
        ];
    }
}
