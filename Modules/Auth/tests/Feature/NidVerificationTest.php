<?php

namespace Modules\Auth\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Events\NidVerified;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NidVerificationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function authenticated_citizen_can_verify_valid_ten_digit_smart_nid_and_receive_blue_badge()
    {
        $user = User::create([
            'name' => 'Kazi Nazrul',
            'email' => 'nazrul@zengfy.top',
            'password' => Hash::make('SecretPass123!'),
        ]);

        $token = $user->createToken('Central Session')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/nid/verify', [
                'nid_number' => '1234567890',
                'date_of_birth' => '1995-05-25',
            ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'nid_verified',
                    'verified_badge',
                    'masked_nid',
                    'nid_verified_at',
                    'citizen_name',
                    'status',
                ],
                'meta' => ['request_id', 'timestamp'],
            ])
            ->assertJson([
                'success' => true,
                'data' => [
                    'nid_verified' => true,
                    'verified_badge' => true,
                    'masked_nid' => '******7890',
                    'status' => 'VERIFIED',
                ],
            ]);

        $refreshed = $user->fresh();
        $this->assertTrue((bool) $refreshed->nid_verified);
        $this->assertTrue((bool) $refreshed->verified_badge);
        $this->assertEquals('1234567890', $refreshed->nid_number);
    }

    #[Test]
    public function nid_number_is_encrypted_at_rest_in_the_database()
    {
        $user = User::create([
            'name' => 'Lalon Shah',
            'email' => 'lalon@zengfy.top',
            'password' => Hash::make('SecretPass123!'),
        ]);

        $token = $user->createToken('Central Session')->plainTextToken;

        $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/nid/verify', [
                'nid_number' => '5566778899',
                'date_of_birth' => '1990-10-17',
            ])
            ->assertStatus(200);

        // Raw database query (bypassing Eloquent decryptor)
        $rawUser = DB::table('users')->where('id', $user->id)->first();

        // Must NOT store plaintext NID in MySQL/SQLite
        $this->assertNotEquals('5566778899', $rawUser->nid_number);

        // Must be Laravel encrypted payload (serialized base64 JSON payload)
        $this->assertStringStartsWith('eyJ', $rawUser->nid_number);

        // Eloquent model must transparently decrypt
        $eloquentUser = User::find($user->id);
        $this->assertEquals('5566778899', $eloquentUser->nid_number);
    }

    #[Test]
    public function duplicate_nid_registration_by_another_user_is_blocked_via_blind_index()
    {
        $citizenA = User::create([
            'name' => 'Citizen A',
            'email' => 'citizena@zengfy.top',
            'password' => Hash::make('Password123!'),
        ]);
        $tokenA = $citizenA->createToken('Session A')->plainTextToken;

        // Citizen A successfully verifies NID
        $this->withHeader('Authorization', "Bearer {$tokenA}")
            ->postJson('/api/v1/auth/nid/verify', [
                'nid_number' => '9876543210',
                'date_of_birth' => '1992-03-12',
            ])
            ->assertStatus(200);

        // Citizen B attempts to verify the SAME NID
        $citizenB = User::create([
            'name' => 'Citizen B (Fraudulent Attempt)',
            'email' => 'citizenb@zengfy.top',
            'password' => Hash::make('Password123!'),
        ]);
        $tokenB = $citizenB->createToken('Session B')->plainTextToken;

        // Reset auth guard memoization between sequential test requests
        auth()->forgetGuards();

        $duplicateResponse = $this->withHeader('Authorization', "Bearer {$tokenB}")
            ->postJson('/api/v1/auth/nid/verify', [
                'nid_number' => '9876543210',
                'date_of_birth' => '1992-03-12',
            ]);

        $duplicateResponse->assertStatus(409)
            ->assertJson([
                'success' => false,
                'meta' => [
                    'error_code' => 'NID_ALREADY_CLAIMED',
                ],
            ]);
    }

    #[Test]
    public function invalid_nid_format_or_missing_dob_fails_validation()
    {
        $user = User::create([
            'name' => 'Tester',
            'email' => 'tester@zengfy.top',
            'password' => Hash::make('Password123!'),
        ]);
        $token = $user->createToken('Session')->plainTextToken;

        // Invalid 5-digit NID
        $response = $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/nid/verify', [
                'nid_number' => '12345',
                'date_of_birth' => '1990-01-01',
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nid_number']);

        // Invalid Date Format
        $dobResponse = $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/nid/verify', [
                'nid_number' => '1234567890',
                'date_of_birth' => '25-12-1990', // Must be YYYY-MM-DD
            ]);

        $dobResponse->assertStatus(422)
            ->assertJsonValidationErrors(['date_of_birth']);
    }

    #[Test]
    public function sandbox_gateway_rejects_non_existent_nid_starting_with_999()
    {
        $user = User::create([
            'name' => 'Non Existent Citizen',
            'email' => 'fake@zengfy.top',
            'password' => Hash::make('Password123!'),
        ]);
        $token = $user->createToken('Session')->plainTextToken;

        $response = $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/nid/verify', [
                'nid_number' => '9990001122',
                'date_of_birth' => '1999-09-09',
            ]);

        $response->assertStatus(422)
            ->assertJson([
                'success' => false,
                'message' => 'NID record not found in Election Commission database.',
                'meta' => [
                    'error_code' => 'NOT_FOUND',
                ],
            ]);
    }

    #[Test]
    public function citizen_already_verified_cannot_verify_again()
    {
        $user = User::create([
            'name' => 'Verified User',
            'email' => 'verified@zengfy.top',
            'password' => Hash::make('Password123!'),
        ]);
        $token = $user->createToken('Session')->plainTextToken;

        // First verification succeeds
        $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/nid/verify', [
                'nid_number' => '1122334455',
                'date_of_birth' => '1988-08-08',
            ])
            ->assertStatus(200);

        // Second verification attempt is blocked
        $secondAttempt = $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/nid/verify', [
                'nid_number' => '1122334455',
                'date_of_birth' => '1988-08-08',
            ]);

        $secondAttempt->assertStatus(400)
            ->assertJson([
                'success' => false,
                'meta' => [
                    'error_code' => 'ALREADY_VERIFIED',
                ],
            ]);
    }

    #[Test]
    public function citizen_can_fetch_current_nid_status_and_see_masked_nid()
    {
        $user = User::create([
            'name' => 'Citizen Status Check',
            'email' => 'status@zengfy.top',
            'password' => Hash::make('Password123!'),
        ]);
        $token = $user->createToken('Session')->plainTextToken;

        // Verify
        $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/nid/verify', [
                'nid_number' => '7788990011',
                'date_of_birth' => '1993-04-14',
            ])
            ->assertStatus(200);

        // Fetch Status
        $statusResponse = $this->withHeader('Authorization', "Bearer {$token}")
            ->getJson('/api/v1/auth/nid/status');

        $statusResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'nid_verified' => true,
                    'verified_badge' => true,
                    'masked_nid' => '******0011',
                    'date_of_birth' => '1993-04-14',
                ],
            ]);
    }

    #[Test]
    public function successful_verification_dispatches_nid_verified_domain_event()
    {
        Event::fake([NidVerified::class]);

        $user = User::create([
            'name' => 'Event Citizen',
            'email' => 'event@zengfy.top',
            'password' => Hash::make('Password123!'),
        ]);
        $token = $user->createToken('Session')->plainTextToken;

        $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson('/api/v1/auth/nid/verify', [
                'nid_number' => '4455667788',
                'date_of_birth' => '1996-06-06',
            ])
            ->assertStatus(200);

        Event::assertDispatched(NidVerified::class, function ($event) use ($user) {
            return $event->user->id === $user->id
                && $event->maskedNid === '******7788';
        });
    }
}
