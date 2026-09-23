<?php

namespace Modules\Auth\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Events\AccountLockoutTriggered;
use Modules\Auth\Services\BruteForceProtectionService;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BruteForceLockoutTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function failed_login_attempts_under_threshold_return_401_without_lockout()
    {
        User::create([
            'name' => 'Target User',
            'email' => 'victim@zengfy.test',
            'password' => Hash::make('StrongSecret123!'),
        ]);

        // First 4 attempts return 401 Unauthorized
        for ($i = 1; $i <= 4; $i++) {
            $response = $this->postJson('/api/v1/auth/login', [
                'email' => 'victim@zengfy.test',
                'password' => "wrong-guess-{$i}",
            ]);

            $response->assertStatus(401)
                ->assertJson([
                    'success' => false,
                    'message' => 'Invalid email or password.',
                ]);
        }
    }

    #[Test]
    public function fifth_failed_attempt_triggers_tier_one_lockout_with_60_second_cooldown()
    {
        User::create([
            'name' => 'Target User',
            'email' => 'victim@zengfy.test',
            'password' => Hash::make('StrongSecret123!'),
        ]);

        for ($i = 1; $i <= 4; $i++) {
            $this->postJson('/api/v1/auth/login', [
                'email' => 'victim@zengfy.test',
                'password' => 'wrong-pass',
            ]);
        }

        // 5th failed attempt triggers Tier 1 (60s cooldown, HTTP 429)
        $fifthResponse = $this->postJson('/api/v1/auth/login', [
            'email' => 'victim@zengfy.test',
            'password' => 'wrong-pass',
        ]);

        $fifthResponse->assertStatus(429)
            ->assertHeader('Retry-After', '60')
            ->assertJson([
                'success' => false,
                'meta' => [
                    'error_code' => 'RATE_LIMITED',
                    'retry_after' => 60,
                    'level' => 'cooldown',
                ],
            ]);
    }

    #[Test]
    public function login_is_blocked_during_tier_one_cooldown_even_with_correct_password()
    {
        $user = User::create([
            'name' => 'Secured Account',
            'email' => 'secure@zengfy.test',
            'password' => Hash::make('MyLegitimatePassword456!'),
        ]);

        // Trigger 5 failed attempts
        for ($i = 1; $i <= 5; $i++) {
            $this->postJson('/api/v1/auth/login', [
                'email' => 'secure@zengfy.test',
                'password' => 'attacker-guess',
            ]);
        }

        // Submit request with the CORRECT password while lockout is active
        $response = $this->postJson('/api/v1/auth/login', [
            'email' => 'secure@zengfy.test',
            'password' => 'MyLegitimatePassword456!',
        ]);

        // Must still be rejected with 429 because the account is in cooldown
        $response->assertStatus(429)
            ->assertJson([
                'success' => false,
                'meta' => [
                    'error_code' => 'RATE_LIMITED',
                    'reason' => 'account',
                ],
            ]);
    }

    #[Test]
    public function successful_login_clears_failed_attempt_counters()
    {
        $user = User::create([
            'name' => 'Active Citizen',
            'email' => 'citizen@zengfy.test',
            'password' => Hash::make('Password789!'),
        ]);

        // 3 failed attempts
        for ($i = 1; $i <= 3; $i++) {
            $this->postJson('/api/v1/auth/login', [
                'email' => 'citizen@zengfy.test',
                'password' => 'mistyped-pass',
            ]);
        }

        // 4th attempt with correct password
        $successResponse = $this->postJson('/api/v1/auth/login', [
            'email' => 'citizen@zengfy.test',
            'password' => 'Password789!',
        ]);

        $successResponse->assertStatus(200);

        // A subsequent wrong password starts back from 1, NOT 4
        $nextFail = $this->postJson('/api/v1/auth/login', [
            'email' => 'citizen@zengfy.test',
            'password' => 'mistyped-again',
        ]);

        $nextFail->assertStatus(401); // 1st attempt after reset is 401, not 429
    }

    #[Test]
    public function ten_failed_attempts_trigger_tier_two_extended_15_minute_lockout()
    {
        User::create([
            'name' => 'Target Account',
            'email' => 'vip@zengfy.test',
            'password' => Hash::make('VipPassword123!'),
        ]);

        // 9 failed attempts
        for ($i = 1; $i <= 9; $i++) {
            $this->postJson('/api/v1/auth/login', [
                'email' => 'vip@zengfy.test',
                'password' => "wrong-pass-{$i}",
            ]);
        }

        // 10th failed attempt triggers Tier 2 (15 minutes / 900s cooldown)
        $tenthResponse = $this->postJson('/api/v1/auth/login', [
            'email' => 'vip@zengfy.test',
            'password' => 'wrong-pass-10',
        ]);

        $tenthResponse->assertStatus(429)
            ->assertHeader('Retry-After', '900')
            ->assertJson([
                'success' => false,
                'meta' => [
                    'error_code' => 'RATE_LIMITED',
                    'retry_after' => 900,
                    'level' => 'extended',
                ],
            ]);
    }

    #[Test]
    public function tier_two_lockout_dispatches_account_lockout_triggered_event()
    {
        Event::fake([AccountLockoutTriggered::class]);

        User::create([
            'name' => 'Alert Target',
            'email' => 'alert@zengfy.test',
            'password' => Hash::make('SecretPass123!'),
        ]);

        for ($i = 1; $i <= 10; $i++) {
            $this->postJson('/api/v1/auth/login', [
                'email' => 'alert@zengfy.test',
                'password' => "bad-pass-{$i}",
            ]);
        }

        Event::assertDispatched(AccountLockoutTriggered::class, function ($event) {
            return $event->email === 'alert@zengfy.test'
                && $event->failedAttempts === 10
                && $event->retryAfterSeconds === 900;
        });
    }

    #[Test]
    public function distributed_botnet_ip_attack_locks_target_account()
    {
        User::create([
            'name' => 'Target VIP',
            'email' => 'founder@zengfy.test',
            'password' => Hash::make('FounderSecurityKey999!'),
        ]);

        // 5 rotating bot IPs attack the same email
        $botIps = [
            '185.220.101.5',
            '185.220.101.6',
            '185.220.101.7',
            '185.220.101.8',
            '185.220.101.9',
        ];

        foreach ($botIps as $index => $ip) {
            $this->withServerVariables(['REMOTE_ADDR' => $ip])
                ->postJson('/api/v1/auth/login', [
                    'email' => 'founder@zengfy.test',
                    'password' => "brute-force-guess-{$index}",
                ]);
        }

        // A 6th brand new bot IP attempts to attack the same account
        $newBotResponse = $this->withServerVariables(['REMOTE_ADDR' => '192.0.2.100'])
            ->postJson('/api/v1/auth/login', [
                'email' => 'founder@zengfy.test',
                'password' => 'another-bot-guess',
            ]);

        // Must be blocked by Account-level shield even though this IP has made 0 previous requests
        $newBotResponse->assertStatus(429)
            ->assertJson([
                'success' => false,
                'meta' => [
                    'error_code' => 'RATE_LIMITED',
                    'reason' => 'account',
                ],
            ]);
    }
}
