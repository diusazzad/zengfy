<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Social\Models\Post;
use Modules\Social\Models\PostMedia;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    Storage::fake('public');
});

test('authenticated citizen can create post with image upload and it persists to database and storage', function () {
    $user = User::factory()->create([
        'handle' => 'sovereign_author',
        'ward_code' => 'WARD-DHAKA-19',
    ]);

    $imageFile = UploadedFile::fake()->create('neighborhood.jpg', 200, 'image/jpeg');

    $response = $this->actingAs($user)
        ->post('/posts', [
            'content' => 'Road construction completed on Road 11!',
            'ward_code' => 'WARD-DHAKA-19',
            'image' => $imageFile,
        ], [
            'Accept' => 'application/json',
            'X-Requested-With' => 'XMLHttpRequest',
        ]);

    $response->assertStatus(201);
    $data = $response->json('data');

    expect($data['id'])->not->toBeNull();
    expect($data['content'])->toBe('Road construction completed on Road 11!');
    expect(count($data['media']))->toBe(1);

    // Verify database persistence
    $this->assertDatabaseHas('posts', [
        'id' => $data['id'],
        'user_id' => $user->id,
        'content' => 'Road construction completed on Road 11!',
        'ward_code' => 'WARD-DHAKA-19',
    ]);

    $media = PostMedia::where('post_id', $data['id'])->first();
    expect($media)->not->toBeNull();
    expect($media->media_type)->toBe('image');
    Storage::disk('public')->assertExists($media->storage_path);
});

test('citizen can toggle like on a post and it updates database and counters', function () {
    $author = User::factory()->create();
    $liker = User::factory()->create();

    $post = Post::create([
        'user_id' => $author->id,
        'content' => 'Testing like interaction',
        'visibility' => 'public',
        'ward_code' => 'WARD-DHAKA-19',
        'likes_count' => 0,
    ]);

    // First like
    $response = $this->actingAs($liker)
        ->post("/posts/{$post->id}/like", [], [
            'Accept' => 'application/json',
        ]);

    $response->assertStatus(200);
    expect($response->json('data.liked'))->toBeTrue();
    expect($response->json('data.likes_count'))->toBe(1);

    $this->assertDatabaseHas('likes', [
        'user_id' => $liker->id,
        'post_id' => $post->id,
    ]);

    // Unlike
    $response2 = $this->actingAs($liker)
        ->post("/posts/{$post->id}/like", [], [
            'Accept' => 'application/json',
        ]);

    $response2->assertStatus(200);
    expect($response2->json('data.liked'))->toBeFalse();
    expect($response2->json('data.likes_count'))->toBe(0);

    $this->assertDatabaseMissing('likes', [
        'user_id' => $liker->id,
        'post_id' => $post->id,
    ]);
});

test('feed page renders database posts with media correctly', function () {
    $author = User::factory()->create([
        'name' => 'Sovereign Citizen',
        'handle' => 'sov_cit',
    ]);

    $post = Post::create([
        'user_id' => $author->id,
        'content' => 'Verified post in feed stream with photo',
        'visibility' => 'public',
        'ward_code' => 'WARD-DHAKA-19',
        'likes_count' => 5,
    ]);

    PostMedia::create([
        'post_id' => $post->id,
        'media_type' => 'image',
        'url' => 'http://localhost/storage/posts/photo.jpg',
        'storage_path' => 'posts/photo.jpg',
        'mime_type' => 'image/jpeg',
        'file_size_bytes' => 1024,
    ]);

    $response = $this->actingAs($author)->get('/feed');

    $response->assertStatus(200);
    $response->assertSee('Verified post in feed stream with photo');
    $response->assertSee('http://localhost/storage/posts/photo.jpg');
});
