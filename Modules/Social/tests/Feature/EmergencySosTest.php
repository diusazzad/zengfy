<?php

namespace Modules\Social\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Modules\Social\Events\EmergencyAlertResolved;
use Modules\Social\Events\EmergencyAlertTriggered;
use Modules\Social\Models\EmergencyEvent;
use Tests\TestCase;

class EmergencySosTest extends TestCase
{
    use RefreshDatabase;

    protected User $citizen;
    protected User $otherCitizen;

    protected function setUp(): void
    {
        parent::setUp();

        $this->citizen = User::factory()->create([
            'name' => 'Sazzad Hossain',
            'handle' => 'sazzad',
            'ward_code' => 'WARD-DHAKA-19',
            'thana_code' => 'THANA-GULSHAN',
            'district_code' => 'DIST-DHAKA',
            'verified_badge' => true,
        ]);

        $this->otherCitizen = User::factory()->create([
            'name' => 'Naimur Rahman',
            'handle' => 'naimur',
            'ward_code' => 'WARD-DHAKA-19',
            'thana_code' => 'THANA-GULSHAN',
            'district_code' => 'DIST-DHAKA',
        ]);
    }

    public function test_authenticated_citizen_can_trigger_sos_distress_signal(): void
    {
        Event::fake([EmergencyAlertTriggered::class]);

        $response = $this->actingAs($this->citizen)
            ->postJson('/api/v1/emergency/sos', [
                'latitude' => 23.7925,
                'longitude' => 90.4078,
                'accuracy' => 12.5,
                'ward_code' => 'WARD-DHAKA-19',
                'distress_type' => 'medical',
                'battery_level' => 84,
                'notes' => 'Severe chest pain, need immediate ambulance.',
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.latitude', 23.7925)
            ->assertJsonPath('data.longitude', 90.4078)
            ->assertJsonPath('data.distress_type', 'medical')
            ->assertJsonPath('data.status', 'active');

        $this->assertDatabaseHas('emergency_events', [
            'user_id' => $this->citizen->id,
            'ward_code' => 'WARD-DHAKA-19',
            'distress_type' => 'medical',
            'status' => 'active',
        ]);

        Event::assertDispatched(EmergencyAlertTriggered::class, function ($event) {
            return $event->event->user_id === $this->citizen->id
                && $event->event->distress_type === 'medical';
        });
    }

    public function test_sub_second_broadcast_event_formats_and_channels(): void
    {
        $event = EmergencyEvent::create([
            'user_id' => $this->citizen->id,
            'latitude' => 23.7925,
            'longitude' => 90.4078,
            'accuracy' => 15.0,
            'ward_code' => 'WARD-DHAKA-19',
            'distress_type' => 'accident',
            'battery_level' => 45,
            'status' => 'active',
        ]);

        $broadcastEvent = new EmergencyAlertTriggered($event);

        $channels = $broadcastEvent->broadcastOn();
        $this->assertCount(2, $channels);
        $this->assertEquals('emergency.radius', $channels[0]->name);
        $this->assertEquals('presence-presence.ward.WARD-DHAKA-19', $channels[1]->name);

        $this->assertEquals('emergency.triggered', $broadcastEvent->broadcastAs());

        $payload = $broadcastEvent->broadcastWith();
        $this->assertEquals($event->id, $payload['id']);
        $this->assertEquals('sazzad', $payload['user']['handle']);
        $this->assertTrue($payload['user']['verified_badge']);
        $this->assertEquals(23.7925, $payload['latitude']);
        $this->assertEquals('accident', $payload['distress_type']);
        $this->assertEquals(45, $payload['battery_level']);
    }

    public function test_panic_tap_deduplication_prevents_duplicate_active_alarms(): void
    {
        Event::fake([EmergencyAlertTriggered::class]);

        // First tap
        $response1 = $this->actingAs($this->citizen)
            ->postJson('/api/v1/emergency/sos', [
                'latitude' => 23.7925,
                'longitude' => 90.4078,
                'ward_code' => 'WARD-DHAKA-19',
            ]);

        $response1->assertStatus(201);
        $firstEventId = $response1->json('data.id');

        // Immediate panic second tap (5 seconds later)
        $response2 = $this->actingAs($this->citizen)
            ->postJson('/api/v1/emergency/sos', [
                'latitude' => 23.7925,
                'longitude' => 90.4078,
                'ward_code' => 'WARD-DHAKA-19',
            ]);

        $response2->assertStatus(201);
        $secondEventId = $response2->json('data.id');

        $this->assertEquals($firstEventId, $secondEventId);
        $this->assertEquals(1, EmergencyEvent::where('user_id', $this->citizen->id)->count());
    }

    public function test_citizen_can_resolve_active_sos(): void
    {
        Event::fake([EmergencyAlertResolved::class]);

        $event = EmergencyEvent::create([
            'user_id' => $this->citizen->id,
            'latitude' => 23.7925,
            'longitude' => 90.4078,
            'ward_code' => 'WARD-DHAKA-19',
            'status' => 'active',
        ]);

        $response = $this->actingAs($this->citizen)
            ->postJson("/api/v1/emergency/sos/{$event->id}/resolve", [
                'status' => 'resolved',
                'resolution_notes' => 'Police patrol responded, safe now.',
            ]);

        $response->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.status', 'resolved');

        $this->assertDatabaseHas('emergency_events', [
            'id' => $event->id,
            'status' => 'resolved',
            'resolution_notes' => 'Police patrol responded, safe now.',
        ]);

        Event::assertDispatched(EmergencyAlertResolved::class);
    }

    public function test_non_owner_cannot_resolve_another_citizens_sos(): void
    {
        $event = EmergencyEvent::create([
            'user_id' => $this->citizen->id,
            'latitude' => 23.7925,
            'longitude' => 90.4078,
            'ward_code' => 'WARD-DHAKA-19',
            'status' => 'active',
        ]);

        $response = $this->actingAs($this->otherCitizen)
            ->postJson("/api/v1/emergency/sos/{$event->id}/resolve", [
                'status' => 'resolved',
            ]);

        $response->assertStatus(403);
    }

    public function test_active_alerts_can_be_retrieved_and_filtered_by_ward(): void
    {
        EmergencyEvent::create([
            'user_id' => $this->citizen->id,
            'latitude' => 23.7925,
            'longitude' => 90.4078,
            'ward_code' => 'WARD-DHAKA-19',
            'status' => 'active',
        ]);

        EmergencyEvent::create([
            'user_id' => $this->otherCitizen->id,
            'latitude' => 23.8103,
            'longitude' => 90.4125,
            'ward_code' => 'WARD-DHAKA-20',
            'status' => 'active',
        ]);

        // Filter by WARD-DHAKA-19
        $response = $this->actingAs($this->citizen)
            ->getJson('/api/v1/emergency/active?ward_code=WARD-DHAKA-19');

        $response->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonCount(1, 'data.data')
            ->assertJsonPath('data.data.0.ward_code', 'WARD-DHAKA-19');
    }

    public function test_citizen_can_manage_trusted_emergency_contacts(): void
    {
        // 1. Add Contact
        $response = $this->actingAs($this->citizen)
            ->postJson('/api/v1/emergency/contacts', [
                'contact_name' => 'Fahim Ahmed',
                'contact_phone' => '+8801711223344',
                'relationship' => 'Brother',
                'is_trusted' => true,
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.contact_name', 'Fahim Ahmed');

        $contactId = $response->json('data.id');

        // 2. List Contacts
        $listResponse = $this->actingAs($this->citizen)
            ->getJson('/api/v1/emergency/contacts');

        $listResponse->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.contact_phone', '+8801711223344');

        // 3. Delete Contact
        $deleteResponse = $this->actingAs($this->citizen)
            ->deleteJson("/api/v1/emergency/contacts/{$contactId}");

        $deleteResponse->assertStatus(200);

        $this->assertDatabaseMissing('emergency_contacts', [
            'id' => $contactId,
        ]);
    }
}
