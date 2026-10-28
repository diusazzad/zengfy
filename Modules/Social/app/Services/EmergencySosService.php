<?php

namespace Modules\Social\Services;

use App\Models\User;
use Illuminate\Support\Facades\Redis;
use Modules\Social\Events\EmergencyAlertResolved;
use Modules\Social\Events\EmergencyAlertTriggered;
use Modules\Social\Models\EmergencyContact;
use Modules\Social\Models\EmergencyEvent;

class EmergencySosService
{
    /**
     * Trigger a new Emergency SOS distress signal with sub-second broadcast.
     * Includes 60-second deduplication guard for panic multiple clicks.
     */
    public function triggerSos(User $user, array $data): EmergencyEvent
    {
        // 1. Deduplication check: Avoid multiple active alarms within 60s
        $recentActive = EmergencyEvent::where('user_id', $user->id)
            ->where('status', 'active')
            ->where('created_at', '>=', now()->subSeconds(60))
            ->first();

        if ($recentActive) {
            return $recentActive->load('user');
        }

        // 2. Persist new distress event
        $event = EmergencyEvent::create([
            'user_id' => $user->id,
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'accuracy' => $data['accuracy'] ?? null,
            'ward_code' => $data['ward_code'] ?? $user->ward_code,
            'thana_code' => $data['thana_code'] ?? $user->thana_code,
            'district_code' => $data['district_code'] ?? $user->district_code,
            'status' => 'active',
            'distress_type' => $data['distress_type'] ?? 'general',
            'battery_level' => $data['battery_level'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);

        // 3. Register in Redis Geo-Radius index for proximity searches
        try {
            Redis::geoadd(
                'emergency:active_locations',
                (float) $event->longitude,
                (float) $event->latitude,
                $event->id
            );
        } catch (\Throwable $e) {
            // Graceful fallback when Redis is absent in test/local environments
        }

        // 4. Sub-second WebSocket broadcast to neighborhood presence and emergency channels
        EmergencyAlertTriggered::dispatch($event);

        return $event->load('user');
    }

    /**
     * Resolve or cancel an active SOS distress signal.
     */
    public function resolveSos(User $user, string $eventId, array $data): EmergencyEvent
    {
        $event = EmergencyEvent::findOrFail($eventId);

        if ($event->user_id !== $user->id) {
            abort(403, 'You are not authorized to resolve this emergency distress signal.');
        }

        $event->update([
            'status' => $data['status'] ?? 'resolved',
            'resolved_at' => now(),
            'resolution_notes' => $data['resolution_notes'] ?? null,
        ]);

        // Remove from Redis Geo active index
        try {
            Redis::zrem('emergency:active_locations', $event->id);
        } catch (\Throwable $e) {
            // Fallback
        }

        // Broadcast resolution event
        EmergencyAlertResolved::dispatch($event);

        return $event->load('user');
    }

    /**
     * Get active emergency alerts filtered by optional ward code.
     */
    public function getActiveEvents(?string $wardCode = null, int $perPage = 15)
    {
        $query = EmergencyEvent::with('user')->active();

        if ($wardCode) {
            $query->byWard($wardCode);
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    /**
     * Get emergency distress history for a user.
     */
    public function getUserHistory(User $user, int $perPage = 15)
    {
        return EmergencyEvent::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Add trusted emergency contact.
     */
    public function addContact(User $user, array $data): EmergencyContact
    {
        return EmergencyContact::create([
            'user_id' => $user->id,
            'contact_name' => $data['contact_name'],
            'contact_phone' => $data['contact_phone'],
            'relationship' => $data['relationship'] ?? null,
            'is_trusted' => $data['is_trusted'] ?? true,
        ]);
    }

    /**
     * List user's trusted emergency contacts.
     */
    public function getContacts(User $user)
    {
        return EmergencyContact::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Delete an emergency contact.
     */
    public function deleteContact(User $user, string $contactId): bool
    {
        $contact = EmergencyContact::where('user_id', $user->id)->findOrFail($contactId);
        return (bool) $contact->delete();
    }
}
