<?php

namespace Modules\Social\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Modules\Social\Models\Post;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HyperlocalFeedTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    protected function tearDown(): void
    {
        Cache::flush();
        parent::tearDown();
    }

    protected function createUser(array $overrides = []): User
    {
        static $counter = 100;
        $counter++;

        return User::create(array_merge([
            'name' => "Hyperlocal Citizen {$counter}",
            'email' => "citizen{$counter}@zengfy.test",
            'handle' => "citizen_{$counter}",
            'password' => Hash::make('Secret123!'),
            'ward_code' => 'WARD-DHAKA-19',
            'thana_code' => 'Gulshan',
            'district_code' => 'Dhaka',
        ], $overrides));
    }

    #[Test]
    public function hyperlocal_ward_feed_returns_only_posts_from_designated_ward()
    {
        $user1 = $this->createUser(['ward_code' => 'WARD-DHAKA-19']);
        $user2 = $this->createUser(['ward_code' => 'WARD-DHAKA-20']);

        $post1 = Post::create([
            'user_id' => $user1->id,
            'content' => 'Gulshan Lake clean-up drive this Friday!',
            'ward_code' => 'WARD-DHAKA-19',
            'thana_code' => 'Gulshan',
            'district_code' => 'Dhaka',
            'visibility' => 'public',
        ]);

        $post2 = Post::create([
            'user_id' => $user2->id,
            'content' => 'Banani bazaar fresh vegetables arrived.',
            'ward_code' => 'WARD-DHAKA-20',
            'thana_code' => 'Banani',
            'district_code' => 'Dhaka',
            'visibility' => 'public',
        ]);

        $response = $this->getJson('/api/v1/feed/hyperlocal/WARD-DHAKA-19');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'meta' => [
                    'ward_code' => 'WARD-DHAKA-19',
                    'scope' => 'ward',
                    'is_expanded' => false,
                ],
            ]);

        $ids = collect($response->json('data'))->pluck('id')->all();
        $this->assertContains($post1->id, $ids);
        $this->assertNotContains($post2->id, $ids);
    }

    #[Test]
    public function hyperlocal_feed_supports_keyset_cursor_pagination()
    {
        $author = $this->createUser(['ward_code' => 'WARD-CHATTOGRAM-05']);

        for ($i = 1; $i <= 15; $i++) {
            Post::create([
                'user_id' => $author->id,
                'content' => "Agrabad update {$i}",
                'ward_code' => 'WARD-CHATTOGRAM-05',
                'visibility' => 'public',
                'created_at' => now()->subMinutes(20 - $i),
                'updated_at' => now()->subMinutes(20 - $i),
            ]);
        }

        // Page 1: 5 items
        $page1 = $this->getJson('/api/v1/feed/hyperlocal/WARD-CHATTOGRAM-05?per_page=5');
        $page1->assertStatus(200);
        $this->assertCount(5, $page1->json('data'));
        $this->assertTrue($page1->json('meta.has_more'));
        $nextCursor = $page1->json('meta.next_cursor');

        // Page 2: next 5 items
        $page2 = $this->getJson("/api/v1/feed/hyperlocal/WARD-CHATTOGRAM-05?per_page=5&cursor={$nextCursor}");
        $page2->assertStatus(200);
        $this->assertCount(5, $page2->json('data'));

        $ids1 = collect($page1->json('data'))->pluck('id')->all();
        $ids2 = collect($page2->json('data'))->pluck('id')->all();
        $this->assertEmpty(array_intersect($ids1, $ids2));
    }

    #[Test]
    public function hyperlocal_feed_can_expand_to_thana_when_ward_feed_is_empty()
    {
        $user = $this->createUser([
            'ward_code' => 'WARD-DHAKA-02',
            'thana_code' => 'Uttara',
        ]);

        // Post exists in thana 'Uttara', but in a different ward 'WARD-DHAKA-01'
        $post = Post::create([
            'user_id' => $user->id,
            'content' => 'Uttara sector 3 metro station open',
            'ward_code' => 'WARD-DHAKA-01',
            'thana_code' => 'Uttara',
            'district_code' => 'Dhaka',
            'visibility' => 'public',
        ]);

        // Querying empty ward WARD-DHAKA-02 with thana_code=Uttara triggers fallback
        $response = $this->getJson('/api/v1/feed/hyperlocal/WARD-DHAKA-02?thana_code=Uttara');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'meta' => [
                    'scope' => 'thana',
                    'is_expanded' => true,
                ],
            ]);

        $ids = collect($response->json('data'))->pluck('id')->all();
        $this->assertContains($post->id, $ids);
    }

    #[Test]
    public function ward_notices_endpoint_filters_only_announcements_and_hyperlocal_notices()
    {
        $admin = $this->createUser(['ward_code' => 'WARD-DHAKA-19']);

        $generalPost = Post::create([
            'user_id' => $admin->id,
            'content' => 'Having coffee at cafe',
            'post_type' => 'standard',
            'ward_code' => 'WARD-DHAKA-19',
            'visibility' => 'public',
        ]);

        $civicNotice = Post::create([
            'user_id' => $admin->id,
            'content' => 'Water supply scheduled maintenance on Saturday 8am - 2pm.',
            'post_type' => 'hyperlocal_notice',
            'ward_code' => 'WARD-DHAKA-19',
            'visibility' => 'public',
        ]);

        $announcement = Post::create([
            'user_id' => $admin->id,
            'content' => 'Dengue spraying campaign by City Corporation.',
            'post_type' => 'announcement',
            'ward_code' => 'WARD-DHAKA-19',
            'visibility' => 'public',
        ]);

        $response = $this->getJson('/api/v1/feed/hyperlocal/WARD-DHAKA-19/notices');
        $response->assertStatus(200);

        $ids = collect($response->json('data'))->pluck('id')->all();
        $this->assertContains($civicNotice->id, $ids);
        $this->assertContains($announcement->id, $ids);
        $this->assertNotContains($generalPost->id, $ids);
    }

    #[Test]
    public function ward_stats_endpoint_returns_aggregated_community_pulse()
    {
        $user1 = $this->createUser(['ward_code' => 'WARD-DHAKA-19']);
        $user2 = $this->createUser(['ward_code' => 'WARD-DHAKA-19']);

        // User 1 creates standard post
        Post::create([
            'user_id' => $user1->id,
            'content' => 'Neighborhood watch update',
            'post_type' => 'standard',
            'ward_code' => 'WARD-DHAKA-19',
            'visibility' => 'public',
        ]);

        // User 2 creates civic notice
        Post::create([
            'user_id' => $user2->id,
            'content' => 'Road construction alert',
            'post_type' => 'hyperlocal_notice',
            'ward_code' => 'WARD-DHAKA-19',
            'visibility' => 'public',
        ]);

        $response = $this->getJson('/api/v1/feed/hyperlocal/WARD-DHAKA-19/stats');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'ward_code' => 'WARD-DHAKA-19',
                    'total_posts' => 2,
                    'notices_count' => 1,
                    'active_neighbors_count' => 2,
                ],
            ]);
    }
}
