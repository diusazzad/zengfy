<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    Storage::fake('public');
});

test('authenticated user can upload avatar photo via dedicated avatar endpoint', function () {
    $user = User::factory()->create();

    $file = UploadedFile::fake()->create('profile.jpg', 100, 'image/jpeg');

    $response = $this->actingAs($user)
        ->post('/account/avatar', [
            'avatar' => $file,
        ]);

    $response->assertSessionHasNoErrors();
    $user->refresh();

    expect($user->avatar)->not->toBeNull();
    Storage::disk('public')->assertExists($user->avatar);
    expect($user->avatar_url)->toContain('storage/' . $user->avatar);
});

test('authenticated user can upload avatar via profile update form', function () {
    $user = User::factory()->create();

    $file = UploadedFile::fake()->create('avatar.png', 100, 'image/png');

    $response = $this->actingAs($user)
        ->post('/account/profile', [
            'name' => 'Updated Sovereign Name',
            'handle' => 'sovereign_user',
            'avatar' => $file,
        ]);

    $response->assertSessionHasNoErrors();
    $user->refresh();

    expect($user->name)->toBe('Updated Sovereign Name');
    expect($user->handle)->toBe('sovereign_user');
    expect($user->avatar)->not->toBeNull();
    Storage::disk('public')->assertExists($user->avatar);
});

test('authenticated user can remove their avatar photo', function () {
    $user = User::factory()->create([
        'avatar' => 'avatars/existing.jpg',
    ]);

    Storage::disk('public')->put('avatars/existing.jpg', 'fake image content');
    Storage::disk('public')->assertExists('avatars/existing.jpg');

    $response = $this->actingAs($user)
        ->delete('/account/avatar');

    $response->assertSessionHasNoErrors();
    $user->refresh();

    expect($user->avatar)->toBeNull();
    expect($user->avatar_url)->toBeNull();
    Storage::disk('public')->assertMissing('avatars/existing.jpg');
});

test('invalid file types are rejected for avatar upload', function () {
    $user = User::factory()->create();

    $file = UploadedFile::fake()->create('malicious.pdf', 100, 'application/pdf');

    $response = $this->actingAs($user)
        ->post('/account/avatar', [
            'avatar' => $file,
        ]);

    $response->assertSessionHasErrors(['avatar']);
});
