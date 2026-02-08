<?php

namespace Modules\Main\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Main\Models\Post;
use App\Models\User;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'body' => fake()->paragraph(),
            'image_path' => fake()->boolean(50) ? 'https://images.unsplash.com/photo-' . fake()->numberBetween(1500000000000, 1600000000000) . '?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80' : null,
            'likes_count' => fake()->numberBetween(0, 50),
            'comments_count' => fake()->numberBetween(0, 10),
        ];
    }
}
