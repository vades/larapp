<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
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
            'is_published' => 1,
            'tag_type' => fake()->randomElement(['post', 'place']),
            'views_count' => fake()->numberBetween(5000, 10000),
            'name' => fake()->unique()->word(),
        ];
    }
}
