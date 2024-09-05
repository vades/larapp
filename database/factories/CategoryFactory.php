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
            'project_id' => 1,
            'parent_id' => 1,
            'is_published' => fake()->numberBetween(0, 1),
            'position' => fake()->numberBetween(0, 10),
            'views_count' => fake()->numberBetween(5000, 10000),
            'slug' => fake()->unique()->slug(),
            'lang' => 'en',
            'title' => fake()->sentence(),
            'description' => fake()->text(),
            'image_url' => fake()->imageUrl(),
            'options' => json_encode(['key' => 'value']),
        ];
    }
}
