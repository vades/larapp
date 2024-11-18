<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'project_id' => 1,
            'parent_id' => 0,
            'is_published' => 1,
            'position' => fake()->numberBetween(0, 10),
            'views_count' => fake()->numberBetween(5000, 10000),
            'category_type' => fake()->randomElement(['post', 'place']),
            'slug' => fake()->unique()->slug(),
            'lang' => 'en',
            'title' => fake()->unique()->word(),
            'description' => fake()->text(),
            'image_url' => fake()->imageUrl(),
            'options' => json_encode(['key' => 'value']),
        ];
    }
}
