<?php

namespace Modules\Auth\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NidVerified
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public string $maskedNid;
    public string $verifiedAt;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, string $maskedNid, string $verifiedAt)
    {
        $this->user = $user;
        $this->maskedNid = $maskedNid;
        $this->verifiedAt = $verifiedAt;
    }
}
