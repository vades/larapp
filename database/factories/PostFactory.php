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
            'parent_id' => 0,
            'project_id' => 1,
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
            'options' => json_encode([
                'address' => fake()->address,
                'googleMapEmbedUrl' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2796.241572848425!2d11.075188212281216!3d49.45398477129993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x479f57a581beec25%3A0xd069918617a249e0!2sHauptmarkt%2C%2090403%20N%C3%BCrnberg!5e1!3m2!1sen!2sde!4v1727184778559!5m2!1sen!2sde',
                                     ]),
        ];
    }
}
