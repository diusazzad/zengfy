<?php

namespace Modules\Social\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Social\Models\EmergencyEvent;

class EmergencyAlertResolved implements ShouldBroadcastNow
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
        return 'emergency.resolved';
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
            'user_id' => $this->event->user_id,
            'status' => $this->event->status,
            'resolved_at' => $this->event->resolved_at?->toIso8601String(),
            'resolution_notes' => $this->event->resolution_notes,
        ];
    }
}
