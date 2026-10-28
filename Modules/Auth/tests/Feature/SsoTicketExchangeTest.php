<?php

namespace Modules\Auth\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Http\Controllers\SsoController;
use Modules\Auth\Models\AuthDevice;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SsoTicketExchangeTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function authenticated_user_can_generate_sso_ticket_for_valid_subdomain()
    {
        $user = User::create([
            'name' => 'Alice Rahman',
            'email' => 'alice@zengfy.top',
            'password' => Hash::make('SecretPass123!'),
        ]);

        $token = $user->createToken('Central Web Session')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/sso/ticket', [
                'target_subdomain' => 'school',
            ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'ticket',
                    'target_subdomain',
                    'expires_in',
                    'redirect_url',
                ],
                'meta' => ['request_id', 'timestamp'],
            ])
            ->assertJson([
                'success' => true,
                'data' => [
                    'target_subdomain' => 'school',
                    'expires_in' => SsoController::TICKET_TTL_SECONDS,
                ],
            ]);

        $ticket = $response->json('data.ticket');
        $this->assertStringStartsWith('sso_tkt_', $ticket);

        // Verify ticket is stored in cache with target subdomain & user id
        $cached = Cache::get("sso_ticket:{$ticket}");
        $this->assertNotNull($cached);
        $this->assertEquals($user->id, $cached['user_id']);
        $this->assertEquals('school', $cached['target_subdomain']);
    }

    #[Test]
    public function unauthenticated_user_cannot_generate_sso_ticket()
    {
        $response = $this->postJson('/api/v1/auth/sso/ticket', [
            'target_subdomain' => 'school',
        ]);

        $response->assertStatus(401);
    }

    #[Test]
    public function generating_ticket_fails_for_unwhitelisted_subdomain()
    {
        $user = User::create([
            'name' => 'Bob Builder',
            'email' => 'bob@zengfy.top',
            'password' => Hash::make('SecretPass123!'),
        ]);

        $token = $user->createToken('Central Session')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/sso/ticket', [
                'target_subdomain' => 'phishing-site-attack',
            ]);

        $response->assertStatus(422)
            ->assertJson([
                'success' => false,
            ]);
    }

    #[Test]
    public function target_subdomain_can_exchange_valid_ticket_for_scoped_session_token()
    {
        $user = User::create([
            'name' => 'Farhan Ahmed',
            'email' => 'farhan@zengfy.top',
            'password' => Hash::make('FarhanSecure99!'),
        ]);

        $token = $user->createToken('Central Session')->plainTextToken;

        // 1. Generate SSO ticket for 'school'
        $ticketResponse = $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/sso/ticket', [
                'target_subdomain' => 'school',
            ]);

        $ticket = $ticketResponse->json('data.ticket');

        // 2. Exchange ticket on school.zengfy.top
        $exchangeResponse = $this->postJson('/api/v1/auth/sso/exchange', [
            'ticket' => $ticket,
            'subdomain' => 'school',
            'device_name' => 'School Computer Lab #3',
        ]);

        $exchangeResponse->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'user' => ['id', 'name', 'email'],
                    'token',
                    'subdomain',
                    'device' => ['id', 'device_name', 'last_active_at'],
                ],
            ])
            ->assertJson([
                'success' => true,
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'email' => 'farhan@zengfy.top',
                    ],
                    'subdomain' => 'school',
                    'device' => [
                        'device_name' => 'School Computer Lab #3',
                    ],
                ],
            ]);

        // Device session must be recorded in auth_devices
        $this->assertDatabaseHas('auth_devices', [
            'user_id' => $user->id,
            'device_name' => 'School Computer Lab #3',
        ]);
    }

    #[Test]
    public function replay_defense_prevents_exchanging_the_same_ticket_twice()
    {
        $user = User::create([
            'name' => 'Nasir Hossain',
            'email' => 'nasir@zengfy.top',
            'password' => Hash::make('NasirPass123!'),
        ]);

        $token = $user->createToken('Central Session')->plainTextToken;

        // Generate ticket
        $ticketResponse = $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/sso/ticket', [
                'target_subdomain' => 'pos',
            ]);

        $ticket = $ticketResponse->json('data.ticket');

        // 1st Exchange attempt -> succeeds (200 OK)
        $firstExchange = $this->postJson('/api/v1/auth/sso/exchange', [
            'ticket' => $ticket,
            'subdomain' => 'pos',
        ]);
        $firstExchange->assertStatus(200);

        // 2nd Exchange attempt with identical ticket -> MUST be rejected (401 Unauthorized)
        $secondExchange = $this->postJson('/api/v1/auth/sso/exchange', [
            'ticket' => $ticket,
            'subdomain' => 'pos',
        ]);
        $secondExchange->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Invalid or expired SSO ticket.',
            ]);
    }

    #[Test]
    public function expired_ticket_is_rejected()
    {
        $user = User::create([
            'name' => 'Tanvir Alam',
            'email' => 'tanvir@zengfy.top',
            'password' => Hash::make('TanvirSecure77!'),
        ]);

        $token = $user->createToken('Central Session')->plainTextToken;

        $ticketResponse = $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/sso/ticket', [
                'target_subdomain' => 'law',
            ]);

        $ticket = $ticketResponse->json('data.ticket');

        // Fast-forward time past the 60-second TTL
        $this->travel(65)->seconds();

        // Exchange attempt after TTL expiry must fail with 401
        $exchangeResponse = $this->postJson('/api/v1/auth/sso/exchange', [
            'ticket' => $ticket,
            'subdomain' => 'law',
        ]);

        $exchangeResponse->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Invalid or expired SSO ticket.',
            ]);
    }

    #[Test]
    public function subdomain_spoofing_prevented_when_exchanging_ticket_on_mismatched_domain()
    {
        $user = User::create([
            'name' => 'Target User',
            'email' => 'target@zengfy.top',
            'password' => Hash::make('TargetSecure123!'),
        ]);

        $token = $user->createToken('Central Session')->plainTextToken;

        // User requested ticket specifically for 'school'
        $ticketResponse = $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/sso/ticket', [
                'target_subdomain' => 'school',
            ]);

        $ticket = $ticketResponse->json('data.ticket');

        // Attacker attempts to exchange this 'school' ticket on 'pos' subdomain
        $maliciousExchange = $this->postJson('/api/v1/auth/sso/exchange', [
            'ticket' => $ticket,
            'subdomain' => 'pos',
        ]);

        $maliciousExchange->assertStatus(403)
            ->assertJson([
                'success' => false,
                'message' => 'SSO ticket was not issued for this domain.',
            ]);
    }
}
