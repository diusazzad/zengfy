<?php

namespace Modules\Auth\Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

use PHPUnit\Framework\Attributes\Test;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_user_can_register_successfully_and_receives_uuid_and_token()
    {
        Event::fake([UserRegistered::class]);

        $response = $this->postJson('/api/v1/auth/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'securepassword123',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'user' => ['id', 'name', 'email'],
                    'token',
                ]
            ]);

        // Assert user exists in database with a UUID string
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);

        $user = User::where('email', 'john@example.com')->first();
        $this->assertIsString($user->id);
        $this->assertEquals(36, strlen($user->id)); // UUID length is 36 chars

        // Assert Event was dispatched asynchronously
        Event::assertDispatched(UserRegistered::class, function ($event) use ($user) {
            return $event->user->id === $user->id;
        });
    }

    #[Test]
    public function registration_fails_if_email_is_already_taken()
    {
        User::create([
            'name' => 'Existing User',
            'email' => 'duplicate@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/v1/auth/register', [
            'name' => 'New User',
            'email' => 'duplicate@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    #[Test]
    public function idempotency_key_prevents_duplicate_user_creation()
    {
        $payload = [
            'name' => 'Idempotent User',
            'email' => 'idempotent@example.com',
            'password' => 'password123',
        ];

        $headers = [
            'X-Idempotency-Key' => 'unique-request-token-12345'
        ];

        // 1st Attempt: Creates user (201 Created)
        $firstResponse = $this->postJson('/api/v1/auth/register', $payload, $headers);
        $firstResponse->assertStatus(201);

        // 2nd Attempt with same key (e.g. user double-clicks or retry on network lag)
        $secondResponse = $this->postJson('/api/v1/auth/register', $payload, $headers);

        // Should return cached response with 200 OK without failing unique email constraint
        $secondResponse->assertStatus(200);

        // Only 1 user should exist in DB
        $this->assertEquals(1, User::where('email', 'idempotent@example.com')->count());
    }

    #[Test]
    public function rate_limiter_blocks_excessive_registration_attempts()
    {
        $payload = [
            'name' => 'Bot Attacker',
            'email' => 'bot@example.com',
            'password' => 'password123',
        ];

        // First 5 requests allowed
        for ($i = 0; $i < 5; $i++) {
            $this->postJson('/api/v1/auth/register', array_merge($payload, ['email' => "bot{$i}@example.com"]));
        }

        // 6th request must be blocked by rate limiter (HTTP 429 Too Many Requests)
        $blockedResponse = $this->postJson('/api/v1/auth/register', [
            'name' => 'Bot 6',
            'email' => 'bot6@example.com',
            'password' => 'password123',
        ]);

        $blockedResponse->assertStatus(429);
    }
}
