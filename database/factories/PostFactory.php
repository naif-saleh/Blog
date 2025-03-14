<?php

namespace Database\Factories;

use App\Models\User;
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
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(5),
            'slug' => $this->faker->slug,
            'body' => $this->faker->paragraph(10),
            'image' => $this->faker->imageUrl(),
            'published_at' => $this->faker->dateTime,
            'featured' => $this->faker->boolean,
        ];
    }
}
