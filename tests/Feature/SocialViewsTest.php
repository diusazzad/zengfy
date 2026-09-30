<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class SocialViewsTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_renders_the_hyperlocal_social_feed_view_successfully(): void
    {
        $response = $this->get('/feed');

        $response->assertStatus(200);
        $response->assertSee('socialFeed()', false);
        $response->assertSee('WARD-DHAKA-19');
        $response->assertSee('Ward 19 Pulse');
        $response->assertSee('DNCC Emergency Notice');
        $response->assertSee('Publish');
        $response->assertSee('Zengfy');
    }

    public function test_it_renders_the_citizen_profile_view_for_existing_user(): void
    {
        $user = User::create([
            'id' => (string) Str::uuid(),
            'name' => 'Sazzad Hossain',
            'handle' => 'sazzad',
            'email' => 'sazzad@zengfy.test',
            'password' => bcrypt('Secret123!@#'),
            'ward_code' => 'WARD-DHAKA-19',
            'bio' => 'Lead Architect of Zengfy Ecosystem.',
            'followers_count' => 350,
            'following_count' => 195,
            'friends_count' => 88,
            'verified_badge' => true,
            'nid_verified' => true,
        ]);

        $response = $this->get('/u/' . $user->handle);

        $response->assertStatus(200);
        $response->assertSee('citizenProfile()', false);
        $response->assertSee('Sazzad Hossain');
        $response->assertSee('@sazzad');
        $response->assertSee('Sovereign Citizen');
        $response->assertSee('WARD-DHAKA-19');
        $response->assertSee('Follow');
        $response->assertSee('Add Friend');
    }

    public function test_it_gracefully_renders_the_citizen_profile_for_fallback_handle(): void
    {
        $response = $this->get('/u/naimur');

        $response->assertStatus(200);
        $response->assertSee('citizenProfile()', false);
        $response->assertSee('Naimur');
        $response->assertSee('@naimur');
        $response->assertSee('Follow');
    }
}
