<?php

namespace Modules\Main\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Modules\Main\Models\Post;
use Modules\Main\Models\Comment;
use Modules\Main\Models\Like;

class SocialFeedSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create or ensure we have some users
        $users = User::factory(5)->create();

        // 2. Create posts for these users
        foreach ($users as $user) {
            $posts = Post::factory(fake()->numberBetween(2, 4))->create([
                'user_id' => $user->id
            ]);

            foreach ($posts as $post) {
                // 3. Add some comments
                Comment::factory(fake()->numberBetween(0, 3))->create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id
                ]);

                // 4. Add some likes
                $likeUsers = $users->random(fake()->numberBetween(0, 5));
                foreach ($likeUsers as $likeUser) {
                    Like::create([
                        'post_id' => $post->id,
                        'user_id' => $likeUser->id
                    ]);
                }
            }
        }
    }
}
