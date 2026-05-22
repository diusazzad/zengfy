<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);
it('tracks user device fingerprint and location during registration', function () {
    // 1. we make a fake requierment for registraton
    $registrationData = [
        'name' => 'Tanvir Sazza',
        'email' => 'sazza@zengfy.com',
        'password' => 'SecurePass123!',
        'password_confirmation' => 'SecurePass123!',
        //  we make a fake requierment for registraton
        'device_fingerprint' => 'fp_99abc123xyz',
    ];
    // 2. we make a fake IP Address and User Agent
    $response = $this->withHeaders([
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0',
    ])->withServerVariables([
                'REMOTE_ADDR' => '103.155.220.1', // বাংলাদেশের একটি রিয়েল আইপি (টেস্ট করার জন্য)
            ])->post('/register', $registrationData);
    // 3. check that the registration is successful and redirects to the dashboard
    $response->assertRedirect('/dashboard');
    // 4. we check that the user is saved in the users table
    $this->assertDatabaseHas('users', [
        'email' => 'sazza@zengfy.com',
        'registration_ip' => '103.155.220.1',
        'country_code' => 'IN',
    ]);
    // 5. we check that the device log is created in the user_devices table
    $user = User::where('email', 'sazza@zengfy.com')->first();
    $this->assertDatabaseHas('user_devices', [
        'user_id' => $user->id,
        'device_fingerprint' => 'fp_99abc123xyz',
        'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0',
        'ip_address' => '103.155.220.1',
    ]);
});
