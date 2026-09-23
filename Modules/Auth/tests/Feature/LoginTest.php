<?php

namespace Modules\Auth\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Models\AuthDevice;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_login_with_valid_credentials_and_receives_token_and_device_session()
    {
        $user = User::create([
            'name' => 'Sarah Connor',
            'email' => 'sarah@example.com',
            'password' => Hash::make('Cyberdyne1984!'),
        ]);

        $response = $this->postJson('/api/v1/auth/login', [
            'email' => 'sarah@example.com',
            'password' => 'Cyberdyne1984!',
            'device_name' => 'MacBook Pro M3',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'user' => ['id', 'name', 'email'],
                    'token',
                    'device' => ['id', 'device_name', 'last_active_at'],
                ],
                'meta' => ['request_id', 'timestamp'],
            ])
            ->assertJson([
                'success' => true,
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => 'Sarah Connor',
                        'email' => 'sarah@example.com',
                    ],
                    'device' => [
                        'device_name' => 'MacBook Pro M3',
                    ],
                ],
            ]);

        // Verify device session was saved in auth_devices table
        $this->assertDatabaseHas('auth_devices', [
            'user_id' => $user->id,
            'device_name' => 'MacBook Pro M3',
        ]);
    }

    #[Test]
    public function login_fails_with_invalid_password_or_unregistered_email()
    {
        User::create([
            'name' => 'John Wick',
            'email' => 'john.wick@continental.com',
            'password' => Hash::make('ContinentalRules123!'),
        ]);

        // 1. Wrong Password
        $wrongPasswordResponse = $this->postJson('/api/v1/auth/login', [
            'email' => 'john.wick@continental.com',
            'password' => 'wrong-pass',
        ]);

        $wrongPasswordResponse->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Invalid email or password.',
            ]);

        // 2. Unregistered Email
        $wrongEmailResponse = $this->postJson('/api/v1/auth/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'ContinentalRules123!',
        ]);

        $wrongEmailResponse->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Invalid email or password.',
            ]);
    }

    #[Test]
    public function authenticated_user_can_fetch_profile_and_active_devices_via_me_endpoint()
    {
        $user = User::create([
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'password' => Hash::make('BabbageEngine42!'),
        ]);

        // Seed 2 active devices
        AuthDevice::create([
            'user_id' => $user->id,
            'device_name' => 'Analytical Engine Workstation',
            'ip_address' => '192.168.1.10',
            'user_agent' => 'BabbageOS/1.0',
            'last_active_at' => now(),
        ]);

        AuthDevice::create([
            'user_id' => $user->id,
            'device_name' => 'Lovelace iPhone',
            'ip_address' => '10.0.0.5',
            'user_agent' => 'Mobile Safari',
            'last_active_at' => now()->subHour(),
        ]);

        $token = $user->createToken('Test Token')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer {$token}")
            ->getJson('/api/v1/auth/me');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'user' => ['id', 'name', 'email'],
                    'active_devices' => [
                        '*' => ['id', 'device_name', 'ip_address', 'last_active_at', 'created_at'],
                    ],
                ],
            ]);

        $this->assertCount(2, $response->json('data.active_devices'));
    }

    #[Test]
    public function user_can_logout_current_device()
    {
        $user = User::create([
            'name' => 'Neo',
            'email' => 'neo@matrix.io',
            'password' => Hash::make('RedPillTakeIt!'),
        ]);

        $token = $user->createToken('Nebuchadnezzar Terminal')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/logout');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Successfully logged out from current device.',
            ]);

        // Invalidate in-memory test guard state so subsequent request checks DB
        auth()->forgetGuards();

        // Subsequent authenticated request using the revoked token must fail with 401
        $meResponse = $this->withHeader('Authorization', "Bearer {$token}")
            ->getJson('/api/v1/auth/me');

        $meResponse->assertStatus(401);
    }

    #[Test]
    public function user_can_logout_from_all_devices()
    {
        $user = User::create([
            'name' => 'Trinity',
            'email' => 'trinity@matrix.io',
            'password' => Hash::make('FollowTheWhiteRabbit!'),
        ]);

        // Create 3 tokens and 3 device sessions
        $token1 = $user->createToken('Device 1')->plainTextToken;
        $token2 = $user->createToken('Device 2')->plainTextToken;
        $token3 = $user->createToken('Device 3')->plainTextToken;

        AuthDevice::create([
            'user_id' => $user->id,
            'device_name' => 'Device 1',
            'last_active_at' => now(),
        ]);
        AuthDevice::create([
            'user_id' => $user->id,
            'device_name' => 'Device 2',
            'last_active_at' => now(),
        ]);

        $this->assertEquals(3, $user->tokens()->count());
        $this->assertEquals(2, AuthDevice::where('user_id', $user->id)->count());

        // Call logout-all using token 1
        $response = $this->withHeader('Authorization', "Bearer {$token1}")
            ->postJson('/api/v1/auth/logout-all');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Successfully logged out from all devices.',
            ]);

        // All tokens must be wiped out
        $this->assertEquals(0, $user->tokens()->count());

        // All device sessions must be wiped out
        $this->assertEquals(0, AuthDevice::where('user_id', $user->id)->count());

        // Invalidate in-memory test guard state
        auth()->forgetGuards();

        // Token 2 and 3 must now be rejected
        $this->withHeader('Authorization', "Bearer {$token2}")
            ->getJson('/api/v1/auth/me')
            ->assertStatus(401);

        auth()->forgetGuards();

        $this->withHeader('Authorization', "Bearer {$token3}")
            ->getJson('/api/v1/auth/me')
            ->assertStatus(401);
    }

    #[Test]
    public function rate_limiter_blocks_excessive_login_attempts()
    {
        // 5 allowed attempts
        for ($i = 0; $i < 5; $i++) {
            $this->postJson('/api/v1/auth/login', [
                'email' => 'attacker@evil.com',
                'password' => 'wrong-pass',
            ]);
        }

        // 6th attempt should be blocked by throttle:5,1 middleware (HTTP 429 Too Many Requests)
        $blockedResponse = $this->postJson('/api/v1/auth/login', [
            'email' => 'attacker@evil.com',
            'password' => 'wrong-pass',
        ]);

        $blockedResponse->assertStatus(429);
    }
}
