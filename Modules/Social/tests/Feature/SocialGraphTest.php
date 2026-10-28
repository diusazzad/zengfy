<?php

namespace Modules\Social\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Modules\Social\Models\Follow;
use Modules\Social\Models\Friendship;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SocialGraphTest extends TestCase
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

    #[Test]
    public function user_can_update_profile_and_unique_handle()
    {
        $user = User::create([
            'name' => 'Sazzad Hossain',
            'email' => 'sazzad@zengfy.top',
            'password' => Hash::make('Secret123!'),
        ]);

        Sanctum::actingAs($user);

        $payload = [
            'name' => 'Sazzad Hossain (Verified)',
            'handle' => '@sazzad_eng',
            'bio' => 'Senior Systems Engineer building Zengfy 10M-Scale Ecosystem',
            'ward_code' => 'WARD-19',
            'thana_code' => 'Dhanmondi',
            'district_code' => 'Dhaka',
        ];

        $response = $this->putJson('/api/v1/profile', $payload);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'name' => 'Sazzad Hossain (Verified)',
                    'handle' => 'sazzad_eng',
                    'bio' => 'Senior Systems Engineer building Zengfy 10M-Scale Ecosystem',
                    'ward_code' => 'WARD-19',
                ],
            ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'handle' => 'sazzad_eng',
            'ward_code' => 'WARD-19',
        ]);

        // Duplicate handle validation
        $otherUser = User::create(['name' => 'Imposter', 'email' => 'imposter@test.com', 'password' => Hash::make('pass')]);
        auth()->forgetGuards();
        Sanctum::actingAs($otherUser);

        $duplicateResponse = $this->putJson('/api/v1/profile', ['handle' => 'sazzad_eng']);
        $duplicateResponse->assertStatus(422)
            ->assertJsonValidationErrors(['handle']);
    }

    #[Test]
    public function user_can_follow_another_user_and_counters_increment_atomically()
    {
        $userA = User::create(['name' => 'Citizen A', 'email' => 'a@social.test', 'password' => Hash::make('pass')]);
        $creatorB = User::create(['name' => 'Creator B', 'handle' => 'creator_b', 'email' => 'b@social.test', 'password' => Hash::make('pass')]);

        Sanctum::actingAs($userA);

        $response = $this->postJson("/api/v1/users/{$creatorB->id}/follow");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'following' => true,
                    'target_id' => $creatorB->id,
                ],
            ]);

        $this->assertDatabaseHas('follows', [
            'follower_id' => $userA->id,
            'following_id' => $creatorB->id,
        ]);

        // Verify database counters
        $this->assertEquals(1, $creatorB->fresh()->followers_count);
        $this->assertEquals(1, $userA->fresh()->following_count);

        // Verify cached $O(1)$ counts
        $counts = $creatorB->getGraphCounts();
        $this->assertEquals(1, $counts['followers_count']);
    }

    #[Test]
    public function user_cannot_follow_self()
    {
        $user = User::create(['name' => 'Narcissist', 'email' => 'self@test.com', 'password' => Hash::make('pass')]);
        Sanctum::actingAs($user);

        $response = $this->postJson("/api/v1/users/{$user->id}/follow");

        $response->assertStatus(422)
            ->assertJson([
                'success' => false,
                'meta' => [
                    'error_code' => 'INVALID_ACTION',
                ],
            ]);
    }

    #[Test]
    public function user_can_unfollow_and_counters_decrement()
    {
        $userA = User::create(['name' => 'User A', 'email' => 'a@test.com', 'password' => Hash::make('pass')]);
        $userB = User::create(['name' => 'User B', 'email' => 'b@test.com', 'password' => Hash::make('pass')]);

        Sanctum::actingAs($userA);

        // Follow
        $this->postJson("/api/v1/users/{$userB->id}/follow");
        $this->assertEquals(1, $userB->fresh()->followers_count);

        // Unfollow
        $response = $this->deleteJson("/api/v1/users/{$userB->id}/follow");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'following' => false,
                ],
            ]);

        $this->assertDatabaseMissing('follows', [
            'follower_id' => $userA->id,
            'following_id' => $userB->id,
        ]);

        $this->assertEquals(0, $userB->fresh()->followers_count);
        $this->assertEquals(0, $userA->fresh()->following_count);
    }

    #[Test]
    public function user_can_send_friend_request()
    {
        $userA = User::create(['name' => 'Friend A', 'email' => 'fa@test.com', 'password' => Hash::make('pass')]);
        $userB = User::create(['name' => 'Friend B', 'email' => 'fb@test.com', 'password' => Hash::make('pass')]);

        Sanctum::actingAs($userA);

        $response = $this->postJson("/api/v1/users/{$userB->id}/friend-request");

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => [
                    'sender_id' => $userA->id,
                    'receiver_id' => $userB->id,
                    'status' => 'pending',
                ],
            ]);

        $this->assertDatabaseHas('friendships', [
            'sender_id' => $userA->id,
            'receiver_id' => $userB->id,
            'status' => 'pending',
        ]);
    }

    #[Test]
    public function duplicate_friend_request_is_prevented()
    {
        $userA = User::create(['name' => 'A', 'email' => 'a@test.com', 'password' => Hash::make('pass')]);
        $userB = User::create(['name' => 'B', 'email' => 'b@test.com', 'password' => Hash::make('pass')]);

        Sanctum::actingAs($userA);
        $this->postJson("/api/v1/users/{$userB->id}/friend-request");

        // Attempting to send again fails with 422
        $duplicate = $this->postJson("/api/v1/users/{$userB->id}/friend-request");
        $duplicate->assertStatus(422)
            ->assertJson([
                'success' => false,
                'meta' => [
                    'error_code' => 'INVALID_ACTION',
                ],
            ]);
    }

    #[Test]
    public function receiver_can_accept_friend_request_and_both_become_friends()
    {
        $userA = User::create(['name' => 'Classmate A', 'email' => 'ca@school.test', 'password' => Hash::make('pass')]);
        $userB = User::create(['name' => 'Classmate B', 'email' => 'cb@school.test', 'password' => Hash::make('pass')]);

        Sanctum::actingAs($userA);
        $requestResponse = $this->postJson("/api/v1/users/{$userB->id}/friend-request");
        $friendshipId = $requestResponse->json('data.id');

        // User B accepts request
        auth()->forgetGuards();
        Sanctum::actingAs($userB);

        $acceptResponse = $this->postJson("/api/v1/friend-requests/{$friendshipId}/accept");

        $acceptResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'status' => 'accepted',
                ],
            ]);

        $this->assertDatabaseHas('friendships', [
            'id' => $friendshipId,
            'status' => 'accepted',
        ]);

        // Assert friends count incremented for both
        $this->assertEquals(1, $userA->fresh()->friends_count);
        $this->assertEquals(1, $userB->fresh()->friends_count);
    }

    #[Test]
    public function receiver_can_decline_friend_request()
    {
        $userA = User::create(['name' => 'Stranger A', 'email' => 'sa@test.com', 'password' => Hash::make('pass')]);
        $userB = User::create(['name' => 'Citizen B', 'email' => 'cb2@test.com', 'password' => Hash::make('pass')]);

        Sanctum::actingAs($userA);
        $requestResponse = $this->postJson("/api/v1/users/{$userB->id}/friend-request");
        $friendshipId = $requestResponse->json('data.id');

        // User B declines
        auth()->forgetGuards();
        Sanctum::actingAs($userB);

        $declineResponse = $this->postJson("/api/v1/friend-requests/{$friendshipId}/decline");
        $declineResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'status' => 'declined',
                ],
            ]);

        $this->assertEquals(0, $userA->fresh()->friends_count);
        $this->assertEquals(0, $userB->fresh()->friends_count);
    }

    #[Test]
    public function user_can_remove_mutual_friend()
    {
        $userA = User::create(['name' => 'Former Friend A', 'email' => 'ffa@test.com', 'password' => Hash::make('pass')]);
        $userB = User::create(['name' => 'Former Friend B', 'email' => 'ffb@test.com', 'password' => Hash::make('pass')]);

        Friendship::create([
            'sender_id' => $userA->id,
            'receiver_id' => $userB->id,
            'status' => 'accepted',
        ]);
        $userA->update(['friends_count' => 1]);
        $userB->update(['friends_count' => 1]);

        Sanctum::actingAs($userA);
        $removeResponse = $this->deleteJson("/api/v1/users/{$userB->id}/friends");

        $removeResponse->assertStatus(200);

        $this->assertDatabaseMissing('friendships', [
            'sender_id' => $userA->id,
            'receiver_id' => $userB->id,
        ]);

        $this->assertEquals(0, $userA->fresh()->friends_count);
        $this->assertEquals(0, $userB->fresh()->friends_count);
    }

    #[Test]
    public function public_profile_endpoint_returns_accurate_relationship_state_and_cached_counts()
    {
        $viewer = User::create(['name' => 'Viewer', 'email' => 'viewer@test.com', 'password' => Hash::make('pass')]);
        $celebrity = User::create([
            'name' => 'National Hero',
            'handle' => 'hero_bd',
            'email' => 'hero@test.com',
            'password' => Hash::make('pass'),
            'verified_badge' => true,
        ]);

        // Viewer follows celebrity
        Follow::create(['follower_id' => $viewer->id, 'following_id' => $celebrity->id]);
        $celebrity->update(['followers_count' => 1]);

        Sanctum::actingAs($viewer);

        $response = $this->getJson('/api/v1/users/@hero_bd/profile');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'name' => 'National Hero',
                    'handle' => 'hero_bd',
                    'verified_badge' => true,
                    'counts' => [
                        'followers_count' => 1,
                    ],
                    'relationship' => [
                        'is_following' => true,
                        'is_followed_by' => false,
                        'friendship_status' => null,
                    ],
                ],
            ]);
    }

    #[Test]
    public function followers_and_following_lists_are_paginated()
    {
        $centralUser = User::create(['name' => 'Central User', 'email' => 'central@test.com', 'password' => Hash::make('pass')]);

        for ($i = 1; $i <= 3; $i++) {
            $fan = User::create(['name' => "Fan {$i}", 'email' => "fan{$i}@test.com", 'password' => Hash::make('pass')]);
            Follow::create(['follower_id' => $fan->id, 'following_id' => $centralUser->id]);
        }

        $response = $this->getJson("/api/v1/users/{$centralUser->id}/followers");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'data' => [
                        '*' => ['id', 'follower_id', 'following_id', 'follower' => ['id', 'name']],
                    ],
                    'current_page',
                    'total',
                ],
            ]);

        $this->assertEquals(3, $response->json('data.total'));
    }
}
