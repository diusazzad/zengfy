<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\AuthDevice;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

it('tracks user device fingerprint and location during registration', function () {
    $registrationData = [
        'name' => 'Tanvir Sazza',
        'email' => 'sazza@zengfy.com',
        'password' => 'SecurePass123!',
        'device_name' => 'Chrome on Windows',
    ];

    $response = $this->withHeaders([
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0',
    ])->withServerVariables([
        'REMOTE_ADDR' => '103.155.220.1',
    ])->postJson('/api/v1/auth/register', $registrationData);

    $response->assertStatus(201);

    $this->assertDatabaseHas('users', [
        'email' => 'sazza@zengfy.com',
    ]);

    $user = User::where('email', 'sazza@zengfy.com')->first();
    expect($user)->not->toBeNull();

    $this->assertDatabaseHas('auth_devices', [
        'user_id' => $user->id,
        'ip_address' => '103.155.220.1',
        'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0',
    ]);
});
