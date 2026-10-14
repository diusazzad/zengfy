<?php

namespace Modules\Auth\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_request_password_reset_code()
    {
        $user = User::factory()->create([
            'email' => 'citizen@zengfy.top',
        ]);

        $response = $this->postJson('/api/v1/auth/password/forgot', [
            'email' => 'citizen@zengfy.top',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('password_reset_tokens', [
            'email' => 'citizen@zengfy.top',
        ]);
    }

    #[Test]
    public function request_reset_code_returns_404_for_unknown_email()
    {
        $response = $this->postJson('/api/v1/auth/password/forgot', [
            'email' => 'nonexistent@zengfy.top',
        ]);

        $response->assertStatus(404);
    }

    #[Test]
    public function user_can_verify_code_and_reset_password()
    {
        $user = User::factory()->create([
            'email' => 'citizen@zengfy.top',
            'password' => Hash::make('OldPassword123!'),
        ]);

        // Request code
        $forgotResponse = $this->postJson('/api/v1/auth/password/forgot', [
            'email' => 'citizen@zengfy.top',
        ]);
        $forgotResponse->assertStatus(200);

        // Retrieve OTP code from dev_code payload
        $otp = $forgotResponse->json('data.dev_code');
        $this->assertNotNull($otp);
        $this->assertEquals(6, strlen($otp));

        // Verify code endpoint
        $verifyResponse = $this->postJson('/api/v1/auth/password/verify-code', [
            'email' => 'citizen@zengfy.top',
            'code' => $otp,
        ]);
        $verifyResponse->assertStatus(200);

        // Reset password endpoint
        $resetResponse = $this->postJson('/api/v1/auth/password/reset', [
            'email' => 'citizen@zengfy.top',
            'code' => $otp,
            'password' => 'NewSecurePassword888!',
            'password_confirmation' => 'NewSecurePassword888!',
        ]);

        $resetResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        // Verify database token is cleared
        $this->assertDatabaseMissing('password_reset_tokens', [
            'email' => 'citizen@zengfy.top',
        ]);

        // Verify new password is valid
        $user->refresh();
        $this->assertTrue(Hash::check('NewSecurePassword888!', $user->password));
        $this->assertFalse(Hash::check('OldPassword123!', $user->password));
    }

    #[Test]
    public function reset_password_fails_with_invalid_code()
    {
        $user = User::factory()->create([
            'email' => 'citizen@zengfy.top',
        ]);

        DB::table('password_reset_tokens')->insert([
            'email' => 'citizen@zengfy.top',
            'token' => Hash::make('123456'),
            'created_at' => now(),
        ]);

        $response = $this->postJson('/api/v1/auth/password/reset', [
            'email' => 'citizen@zengfy.top',
            'code' => '999999', // Wrong code
            'password' => 'NewSecurePassword888!',
            'password_confirmation' => 'NewSecurePassword888!',
        ]);

        $response->assertStatus(401);
    }
}
