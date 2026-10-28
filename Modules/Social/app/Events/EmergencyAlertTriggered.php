<?php

namespace Modules\Social\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Social\Models\EmergencyEvent;

class EmergencyAlertTriggered implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public EmergencyEvent $event;

    /**
     * Create a new event instance.
     */
    public function __construct(EmergencyEvent $event)
    {
        $this->event = $event->loadMissing('user');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        $channels = [
            new Channel('emergency.radius'),
        ];

        if ($this->event->ward_code) {
            $channels[] = new PresenceChannel('presence.ward.' . $this->event->ward_code);
        }

        return $channels;
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'emergency.triggered';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'id' => $this->event->id,
            'user' => [
                'id' => $this->event->user->id,
                'name' => $this->event->user->name,
                'handle' => $this->event->user->handle,
                'phone' => $this->event->user->phone ?? null,
                'ward_code' => $this->event->user->ward_code ?? null,
                'verified_badge' => (bool) ($this->event->user->verified_badge ?? false),
            ],
            'latitude' => (float) $this->event->latitude,
            'longitude' => (float) $this->event->longitude,
            'accuracy' => (float) ($this->event->accuracy ?? 0),
            'ward_code' => $this->event->ward_code,
            'distress_type' => $this->event->distress_type,
            'battery_level' => $this->event->battery_level,
            'notes' => $this->event->notes,
            'status' => $this->event->status,
            'created_at' => $this->event->created_at->toIso8601String(),
        ];
    }
}
