<?php

namespace Modules\Auth\Services;

use Illuminate\Support\Facades\Cache;
use Modules\Auth\Events\AccountLockoutTriggered;

class BruteForceProtectionService
{
    public const TIER_1_THRESHOLD = 5;
    public const TIER_1_COOLDOWN_SECONDS = 60; // 1 minute

    public const TIER_2_THRESHOLD = 10;
    public const TIER_2_COOLDOWN_SECONDS = 900; // 15 minutes

    public const ATTEMPT_WINDOW_MINUTES = 30;

    /**
     * Check if the target email or client IP is currently in a lockout state.
     * If caller continues hammering during lockout, escalates to Tier 2 upon reaching 10 attempts.
     */
    public function checkLockout(string $email, string $ip): ?array
    {
        $emailHash = $this->hashEmail($email);
        $now = now()->timestamp;

        $emailLockoutUntil = (int) Cache::get("auth:lockout:email:{$emailHash}", 0);
        $ipLockoutUntil = (int) Cache::get("auth:lockout:ip:{$ip}", 0);

        if ($emailLockoutUntil > $now || $ipLockoutUntil > $now) {
            // Increment attempt counter even during lockout to detect continued assault & escalate
            $emailAttempts = (int) Cache::get("auth:attempts:email:{$emailHash}", 0) + 1;
            Cache::put("auth:attempts:email:{$emailHash}", $emailAttempts, now()->addMinutes(self::ATTEMPT_WINDOW_MINUTES));

            $ipAttempts = (int) Cache::get("auth:attempts:ip:{$ip}", 0) + 1;
            Cache::put("auth:attempts:ip:{$ip}", $ipAttempts, now()->addMinutes(self::ATTEMPT_WINDOW_MINUTES));

            $maxAttempts = max($emailAttempts, $ipAttempts);

            // Escalate to Tier 2 if assault continues to 10 attempts
            if ($maxAttempts >= self::TIER_2_THRESHOLD) {
                $cooldown = self::TIER_2_COOLDOWN_SECONDS;
                $expiresAt = $now + $cooldown;

                Cache::put("auth:lockout:email:{$emailHash}", $expiresAt, now()->addSeconds($cooldown));
                Cache::put("auth:lockout:ip:{$ip}", $expiresAt, now()->addSeconds($cooldown));

                event(new AccountLockoutTriggered($email, $ip, $maxAttempts, $cooldown));

                return [
                    'locked' => true,
                    'retry_after' => $cooldown,
                    'reason' => $emailLockoutUntil > $now ? 'account' : 'ip',
                    'level' => 'extended',
                    'message' => "Account locked due to 10 consecutive failed attempts. Security cooldown active for 15 minutes.",
                ];
            }

            $activeExpiry = max($emailLockoutUntil, $ipLockoutUntil);
            $retryAfter = $activeExpiry - $now;
            $level = $this->resolveLevel($maxAttempts);

            return [
                'locked' => true,
                'retry_after' => max(1, $retryAfter),
                'reason' => $emailLockoutUntil > $now ? 'account' : 'ip',
                'level' => $level,
                'message' => "Too many failed login attempts for this account. Please try again in {$retryAfter} seconds.",
            ];
        }

        return null;
    }

    /**
     * Record a failed login attempt and apply backoff cooldowns if thresholds are exceeded.
     */
    public function recordFailedAttempt(string $email, string $ip): array
    {
        $emailHash = $this->hashEmail($email);

        // Increment failed attempt counters
        $emailAttempts = (int) Cache::get("auth:attempts:email:{$emailHash}", 0) + 1;
        Cache::put("auth:attempts:email:{$emailHash}", $emailAttempts, now()->addMinutes(self::ATTEMPT_WINDOW_MINUTES));

        $ipAttempts = (int) Cache::get("auth:attempts:ip:{$ip}", 0) + 1;
        Cache::put("auth:attempts:ip:{$ip}", $ipAttempts, now()->addMinutes(self::ATTEMPT_WINDOW_MINUTES));

        $maxAttempts = max($emailAttempts, $ipAttempts);
        $now = now()->timestamp;

        // Tier 2: 10+ failed attempts -> 15 minutes lockout + Security Event
        if ($maxAttempts >= self::TIER_2_THRESHOLD) {
            $cooldown = self::TIER_2_COOLDOWN_SECONDS;
            $expiresAt = $now + $cooldown;

            Cache::put("auth:lockout:email:{$emailHash}", $expiresAt, now()->addSeconds($cooldown));
            Cache::put("auth:lockout:ip:{$ip}", $expiresAt, now()->addSeconds($cooldown));

            // Trigger security event for audit and alert notifications
            event(new AccountLockoutTriggered($email, $ip, $maxAttempts, $cooldown));

            return [
                'locked' => true,
                'retry_after' => $cooldown,
                'attempts' => $maxAttempts,
                'level' => 'extended',
                'message' => "Account locked due to 10 consecutive failed attempts. Security cooldown active for 15 minutes.",
            ];
        }

        // Tier 1: 5-9 failed attempts -> 60 seconds cooldown
        if ($maxAttempts >= self::TIER_1_THRESHOLD) {
            $cooldown = self::TIER_1_COOLDOWN_SECONDS;
            $expiresAt = $now + $cooldown;

            Cache::put("auth:lockout:email:{$emailHash}", $expiresAt, now()->addSeconds($cooldown));
            Cache::put("auth:lockout:ip:{$ip}", $expiresAt, now()->addSeconds($cooldown));

            return [
                'locked' => true,
                'retry_after' => $cooldown,
                'attempts' => $maxAttempts,
                'level' => 'cooldown',
                'message' => "Too many failed login attempts. Please slow down and try again in {$cooldown} seconds.",
            ];
        }

        return [
            'locked' => false,
            'retry_after' => 0,
            'attempts' => $maxAttempts,
            'level' => 'none',
            'message' => null,
        ];
    }

    /**
     * Clear failed attempt and lockout counters upon successful login.
     */
    public function clearAttempts(string $email, string $ip): void
    {
        $emailHash = $this->hashEmail($email);

        Cache::forget("auth:attempts:email:{$emailHash}");
        Cache::forget("auth:attempts:ip:{$ip}");
        Cache::forget("auth:lockout:email:{$emailHash}");
        Cache::forget("auth:lockout:ip:{$ip}");
    }

    /**
     * Hash email for privacy and constant-length keying.
     */
    protected function hashEmail(string $email): string
    {
        return hash('sha256', strtolower(trim($email)));
    }

    /**
     * Resolve lockout severity level based on attempt count.
     */
    protected function resolveLevel(int $attempts): string
    {
        if ($attempts >= self::TIER_2_THRESHOLD) {
            return 'extended';
        }

        if ($attempts >= self::TIER_1_THRESHOLD) {
            return 'cooldown';
        }

        return 'none';
    }
}
