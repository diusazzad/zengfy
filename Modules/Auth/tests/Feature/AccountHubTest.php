<?php

namespace Modules\Auth\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Models\AuthDevice;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AccountHubTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function unauthenticated_guest_is_redirected_from_account_hub_to_login()
    {
        $response = $this->get('/account');
        $response->assertRedirect('/login');
    }

    #[Test]
    public function authenticated_user_can_access_account_hub()
    {
        $user = User::factory()->create([
            'name' => 'Sazzad Hossain',
            'email' => 'sazzad@zengfy.top',
        ]);

        $response = $this->actingAs($user)->get('/account');

        $response->assertStatus(200);
        $response->assertSee('Sazzad Hossain');
        $response->assertSee('Sovereign Account Hub');
    }

    #[Test]
    public function user_can_update_profile_details()
    {
        $user = User::factory()->create([
            'name' => 'Original Name',
            'handle' => 'orig_handle',
        ]);

        $response = $this->actingAs($user)->post('/account/profile', [
            'name' => 'Updated Legal Name',
            'handle' => 'updated_handle',
            'bio' => 'New citizen bio.',
            'ward_code' => 'WARD-19',
        ]);

        $response->assertSessionHas('success');

        $user->refresh();
        $this->assertEquals('Updated Legal Name', $user->name);
        $this->assertEquals('updated_handle', $user->handle);
        $this->assertEquals('WARD-19', $user->ward_code);
    }

    #[Test]
    public function user_can_change_password()
    {
        $user = User::factory()->create([
            'password' => Hash::make('CurrentPassword123!'),
        ]);

        $response = $this->actingAs($user)->post('/account/password', [
            'current_password' => 'CurrentPassword123!',
            'new_password' => 'BrandNewPassword999!',
            'new_password_confirmation' => 'BrandNewPassword999!',
        ]);

        $response->assertSessionHas('success');

        $user->refresh();
        $this->assertTrue(Hash::check('BrandNewPassword999!', $user->password));
    }

    #[Test]
    public function user_can_revoke_other_active_devices()
    {
        $user = User::factory()->create();

        $currentDevice = AuthDevice::create([
            'user_id' => $user->id,
            'device_name' => 'Current Browser',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Symfony',
            'last_active_at' => now(),
        ]);

        $otherDevice = AuthDevice::create([
            'user_id' => $user->id,
            'device_name' => 'Old Android Phone',
            'ip_address' => '10.0.0.5',
            'user_agent' => 'Android',
            'last_active_at' => now()->subDay(),
        ]);

        $response = $this->actingAs($user)->post('/account/devices/revoke-all');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('auth_devices', [
            'id' => $otherDevice->id,
        ]);
    }

    #[Test]
    public function user_can_logout_via_web_route()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
