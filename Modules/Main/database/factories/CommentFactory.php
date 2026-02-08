<?php

namespace Modules\Main\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Main\Models\Comment;
use Modules\Main\Models\Post;
use App\Models\User;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'post_id' => Post::factory(),
            'body' => fake()->sentence(),
        ];
    }
}
