<?php

namespace Database\Factories;

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
        return [
            'project_id' => 1,
            'parent_id' => 0,
            'user_id' => 1,
            'is_featured' => fake()->numberBetween(0, 1),
            'post_type' => fake()->randomElement(['post', 'page','place']),
            'post_status' => fake()->randomElement(['draft', 'published','pending']),
            'position' => fake()->numberBetween(0, 10),
            'views_count' => fake()->numberBetween(5000, 10000),
            'slug' => fake()->unique()->slug(),
            'lang' => 'en',
            'title' => fake()->sentence(),
            'subtitle' => fake()->sentence(),
            'description' => fake()->text(),
            'content' => fake()->realText(),
            'image_url' => fake()->imageUrl(),
            'options' => json_encode(['key' => 'value']),
        ];
    }
}
