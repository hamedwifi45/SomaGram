<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\imagepost>
 */
class imagepostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = ['1 (1).jpg', '1 (2).jpg', '1 (3).jpg', '1 (4).jpg', '1 (5).jpg', '1 (6).jpg'];
        return [
            'post_id' => \App\Models\Post::factory(),
            'image_path' => 'posts/' . fake()->randomElement($images),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
