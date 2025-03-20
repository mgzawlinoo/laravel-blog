<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $post = fake()->unique()->randomElement([1,2,3]);
        $tag = fake()->unique()->randomElement([1,2,3]);
        return [
            'post_id' => $post,
            'tag_id' => $tag
        ];
    }
}
