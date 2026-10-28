<?php

namespace Modules\Auth\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AccountLockoutTriggered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $email;
    public string $ipAddress;
    public int $failedAttempts;
    public int $retryAfterSeconds;

    /**
     * Create a new event instance.
     */
    public function __construct(string $email, string $ipAddress, int $failedAttempts, int $retryAfterSeconds)
    {
        $this->email = $email;
        $this->ipAddress = $ipAddress;
        $this->failedAttempts = $failedAttempts;
        $this->retryAfterSeconds = $retryAfterSeconds;
    }
}
