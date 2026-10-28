<?php

namespace Modules\Social\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Modules\Social\Models\Friendship;
use Modules\Social\Models\Post;
use Modules\Social\Models\PostMedia;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PostCreationAndPaginationTest extends TestCase
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
        static $counter = 1;
        $counter++;

        return User::create(array_merge([
            'name' => "User {$counter}",
            'email' => "user{$counter}@zengfy.top",
            'handle' => "user_{$counter}",
            'password' => Hash::make('Password123!'),
            'ward_code' => 'WARD-DHAKA-19',
            'thana_code' => 'Gulshan',
            'district_code' => 'Dhaka',
        ], $overrides));
    }

    #[Test]
    public function user_can_request_presigned_media_upload_url()
    {
        $user = $this->createUser();
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/v1/media/presign', [
            'file_name' => 'national_monument.jpg',
            'mime_type' => 'image/jpeg',
            'file_size_bytes' => 1024 * 500, // 500KB
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'media_type' => 'image',
                    'mime_type' => 'image/jpeg',
                    'file_size_bytes' => 512000,
                ],
            ]);

        $this->assertNotEmpty($response->json('data.upload_url'));
        $this->assertNotEmpty($response->json('data.storage_path'));
        $this->assertNotEmpty($response->json('data.public_url'));
    }

    #[Test]
    public function presign_request_fails_with_invalid_mime_type_or_excessive_size()
    {
        $user = $this->createUser();
        Sanctum::actingAs($user);

        // Invalid MIME type
        $response1 = $this->postJson('/api/v1/media/presign', [
            'file_name' => 'malicious.exe',
            'mime_type' => 'application/x-msdownload',
            'file_size_bytes' => 1024,
        ]);
        $response1->assertStatus(422)
            ->assertJson([
                'meta' => [
                    'error_code' => 'INVALID_MEDIA_SPEC',
                ],
            ]);

        // File size exceeding 15MB for image
        $response2 = $this->postJson('/api/v1/media/presign', [
            'file_name' => 'giant.png',
            'mime_type' => 'image/png',
            'file_size_bytes' => 50 * 1024 * 1024, // 50MB
        ]);
        $response2->assertStatus(422)
            ->assertJson([
                'meta' => [
                    'error_code' => 'INVALID_MEDIA_SPEC',
                ],
            ]);
    }

    #[Test]
    public function user_can_create_text_post_successfully()
    {
        $user = $this->createUser();
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/v1/posts', [
            'content' => 'Hello Zengfy! Launching Hyperlocal Social Network for Bangladesh.',
            'post_type' => 'standard',
            'visibility' => 'public',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => [
                    'content' => 'Hello Zengfy! Launching Hyperlocal Social Network for Bangladesh.',
                    'post_type' => 'standard',
                    'visibility' => 'public',
                    'ward_code' => 'WARD-DHAKA-19', // Auto-inherited from user
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                    ],
                ],
            ]);

        $postId = $response->json('data.id');
        $this->assertDatabaseHas('posts', [
            'id' => $postId,
            'user_id' => $user->id,
            'ward_code' => 'WARD-DHAKA-19',
        ]);
    }

    #[Test]
    public function user_can_create_post_with_media_attachments()
    {
        $user = $this->createUser();
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/v1/posts', [
            'content' => 'Sunset at Cox\'s Bazar beach with friends!',
            'visibility' => 'public',
            'media' => [
                [
                    'url' => 'https://cdn.zengfy.com/media/posts/sunset1.jpg',
                    'storage_path' => 'media/posts/sunset1.jpg',
                    'media_type' => 'image',
                    'mime_type' => 'image/jpeg',
                    'file_size_bytes' => 350000,
                    'width' => 1920,
                    'height' => 1080,
                    'order_column' => 0,
                ],
                [
                    'url' => 'https://cdn.zengfy.com/media/posts/sunset2.jpg',
                    'storage_path' => 'media/posts/sunset2.jpg',
                    'media_type' => 'image',
                    'mime_type' => 'image/jpeg',
                    'file_size_bytes' => 420000,
                    'width' => 1920,
                    'height' => 1080,
                    'order_column' => 1,
                ],
            ],
        ]);

        $response->assertStatus(201);
        $postId = $response->json('data.id');

        $this->assertCount(2, $response->json('data.media'));
        $this->assertEquals('https://cdn.zengfy.com/media/posts/sunset1.jpg', $response->json('data.media.0.url'));
        $this->assertEquals(0, $response->json('data.media.0.order_column'));
        $this->assertEquals(1, $response->json('data.media.1.order_column'));

        $this->assertDatabaseHas('post_media', [
            'post_id' => $postId,
            'url' => 'https://cdn.zengfy.com/media/posts/sunset1.jpg',
        ]);
    }

    #[Test]
    public function empty_post_without_text_or_media_is_rejected()
    {
        $user = $this->createUser();
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/v1/posts', [
            'content' => '   ',
            'media' => [],
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'success' => false,
                'meta' => [
                    'error_code' => 'EMPTY_POST',
                ],
            ]);
    }

    #[Test]
    public function unauthenticated_user_cannot_create_or_delete_posts()
    {
        $postResponse = $this->postJson('/api/v1/posts', [
            'content' => 'Unauthorized post',
        ]);
        $postResponse->assertStatus(401);

        $deleteResponse = $this->deleteJson('/api/v1/posts/non-existent-id');
        $deleteResponse->assertStatus(401);
    }

    #[Test]
    public function user_can_delete_own_post_but_cannot_delete_others_post()
    {
        $owner = $this->createUser();
        $intruder = $this->createUser();

        $post = Post::create([
            'user_id' => $owner->id,
            'content' => 'Owner post',
            'visibility' => 'public',
        ]);

        // Intruder tries to delete
        Sanctum::actingAs($intruder);
        $response1 = $this->deleteJson("/api/v1/posts/{$post->id}");
        $response1->assertStatus(403);
        $this->assertDatabaseHas('posts', ['id' => $post->id]);

        // Owner deletes
        Sanctum::actingAs($owner);
        $response2 = $this->deleteJson("/api/v1/posts/{$post->id}");
        $response2->assertStatus(200);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    #[Test]
    public function public_feed_returns_keyset_cursor_pagination()
    {
        $author = $this->createUser();

        // Create 25 posts with incremental timestamps to guarantee ordering
        $postIds = [];
        for ($i = 1; $i <= 25; $i++) {
            $post = Post::create([
                'user_id' => $author->id,
                'content' => "Post number {$i}",
                'visibility' => 'public',
                'created_at' => now()->subMinutes(30 - $i),
                'updated_at' => now()->subMinutes(30 - $i),
            ]);
            $postIds[] = $post->id;
        }

        // Page 1: 10 items
        $page1 = $this->getJson('/api/v1/feed?per_page=10');
        $page1->assertStatus(200);
        $this->assertCount(10, $page1->json('data'));
        $this->assertTrue($page1->json('meta.has_more'));
        $nextCursor = $page1->json('meta.next_cursor');
        $this->assertNotEmpty($nextCursor);

        $page1Ids = collect($page1->json('data'))->pluck('id')->all();

        // Page 2: 10 items using cursor
        $page2 = $this->getJson("/api/v1/feed?per_page=10&cursor={$nextCursor}");
        $page2->assertStatus(200);
        $this->assertCount(10, $page2->json('data'));
        $this->assertTrue($page2->json('meta.has_more'));
        $nextCursor2 = $page2->json('meta.next_cursor');

        $page2Ids = collect($page2->json('data'))->pluck('id')->all();

        // Ensure no overlapping IDs between page 1 and page 2
        $overlap = array_intersect($page1Ids, $page2Ids);
        $this->assertEmpty($overlap, 'Keyset cursor pagination returned duplicate items across pages');

        // Page 3: remaining 5 items
        $page3 = $this->getJson("/api/v1/feed?per_page=10&cursor={$nextCursor2}");
        $page3->assertStatus(200);
        $this->assertCount(5, $page3->json('data'));
        $this->assertFalse($page3->json('meta.has_more'));
    }

    #[Test]
    public function feed_respects_visibility_rules()
    {
        $author = $this->createUser();
        $friend = $this->createUser();
        $stranger = $this->createUser();

        // Establish mutual accepted friendship between author and friend
        Friendship::create([
            'sender_id' => $author->id,
            'receiver_id' => $friend->id,
            'status' => 'accepted',
        ]);

        $publicPost = Post::create([
            'user_id' => $author->id,
            'content' => 'Public post',
            'visibility' => 'public',
        ]);

        $friendsPost = Post::create([
            'user_id' => $author->id,
            'content' => 'Friends only post',
            'visibility' => 'friends_only',
        ]);

        $privatePost = Post::create([
            'user_id' => $author->id,
            'content' => 'Secret private note',
            'visibility' => 'private',
        ]);

        // 1. Unauthenticated guest: sees only public
        $guestResponse = $this->getJson('/api/v1/feed');
        $guestIds = collect($guestResponse->json('data'))->pluck('id')->all();
        $this->assertContains($publicPost->id, $guestIds);
        $this->assertNotContains($friendsPost->id, $guestIds);
        $this->assertNotContains($privatePost->id, $guestIds);

        // 2. Stranger: sees only public
        Sanctum::actingAs($stranger);
        $strangerResponse = $this->getJson('/api/v1/feed');
        $strangerIds = collect($strangerResponse->json('data'))->pluck('id')->all();
        $this->assertContains($publicPost->id, $strangerIds);
        $this->assertNotContains($friendsPost->id, $strangerIds);
        $this->assertNotContains($privatePost->id, $strangerIds);

        // 3. Mutual friend: sees public AND friends_only, but not private
        Sanctum::actingAs($friend);
        $friendResponse = $this->getJson('/api/v1/feed');
        $friendIds = collect($friendResponse->json('data'))->pluck('id')->all();
        $this->assertContains($publicPost->id, $friendIds);
        $this->assertContains($friendsPost->id, $friendIds);
        $this->assertNotContains($privatePost->id, $friendIds);

        // 4. Author: sees all 3 posts
        Sanctum::actingAs($author);
        $authorResponse = $this->getJson('/api/v1/feed');
        $authorIds = collect($authorResponse->json('data'))->pluck('id')->all();
        $this->assertContains($publicPost->id, $authorIds);
        $this->assertContains($friendsPost->id, $authorIds);
        $this->assertContains($privatePost->id, $authorIds);
    }

    #[Test]
    public function hyperlocal_feed_filters_by_ward_code()
    {
        $user1 = $this->createUser(['ward_code' => 'WARD-DHAKA-17']);
        $user2 = $this->createUser(['ward_code' => 'WARD-DHAKA-18']);

        $post1 = Post::create([
            'user_id' => $user1->id,
            'content' => 'Banani road maintenance notice',
            'ward_code' => 'WARD-DHAKA-17',
            'visibility' => 'public',
        ]);

        $post2 = Post::create([
            'user_id' => $user2->id,
            'content' => 'Mirpur cultural festival',
            'ward_code' => 'WARD-DHAKA-18',
            'visibility' => 'public',
        ]);

        $response = $this->getJson('/api/v1/feed/hyperlocal/WARD-DHAKA-17');
        $response->assertStatus(200);

        $ids = collect($response->json('data'))->pluck('id')->all();
        $this->assertContains($post1->id, $ids);
        $this->assertNotContains($post2->id, $ids);
    }
}
