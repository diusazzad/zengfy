<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('can register a new user successfully', function () {
    $response = $this->postJson('/api/v1/auth/register', [
        'name' => 'Zen User',
        'email' => 'user@zengfy.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertStatus(201)
             ->assertJsonStructure([
                 'status',
                 'message',
                 'data' => [
                     'user' => ['id', 'name', 'email', 'uuid'],
                     'token'
                 ]
             ]);

    $this->assertDatabaseHas('users', [
        'email' => 'user@zengfy.com',
    ]);
});

it('fails registration if email is already taken', function () {
    User::factory()->create(['email' => 'user@zengfy.com']);

    $response = $this->postJson('/api/v1/auth/register', [
        'name' => 'Another User',
        'email' => 'user@zengfy.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertStatus(422)
             ->assertJsonValidationErrors(['email']);
});

it('fails registration if password is too short', function () {
    $response = $this->postJson('/api/v1/auth/register', [
        'name' => 'Zen User',
        'email' => 'user2@zengfy.com',
        'password' => '123',
        'password_confirmation' => '123',
    ]);

    $response->assertStatus(422)
             ->assertJsonValidationErrors(['password']);
});
