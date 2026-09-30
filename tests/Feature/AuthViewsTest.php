<?php

use Tests\TestCase;
use function Pest\Laravel\get;

uses(TestCase::class);

it('renders the sovereign login view successfully', function () {
    $response = get('/login');

    $response->assertStatus(200);
    $response->assertSee('Welcome Back');
    $response->assertSee('Sign In to Zengfy');
    $response->assertSee('loginForm()', false);
    $response->assertSee('Protected by 256-Bit Cloud Encryption');
});

it('renders the sovereign registration view successfully', function () {
    $response = get('/register');

    $response->assertStatus(200);
    $response->assertSee('Create Sovereign Account');
    $response->assertSee('registerForm()', false);
    $response->assertSee('National ID (NID)');
    $response->assertSee('Blue Citizen Badge');
    $response->assertSee('evaluatePasswordStrength', false);
});
