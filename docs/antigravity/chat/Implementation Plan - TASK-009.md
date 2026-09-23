Implementation Plan - TASK-009: Brute-Force Defense & Redis Lockout Engine
Goal Description
Implement an enterprise-grade Brute-Force Defense and Account Lockout Engine to protect millions of citizen accounts from credential stuffing and automated dictionary attacks. The engine implements dual-key tracking (per client IP and per target email), exponential backoff cooldowns, RFC 6585 Retry-After headers, and triggers security alert domain events.

User Review Required
IMPORTANT

Dual-Key Defense Strategy:

Target Account Shield (auth:attempts:email:{hash}): Protects a VIP user if a distributed botnet attacks them from thousands of rotating IPs.
Client IP Shield (auth:attempts:ip:{ip}): Protects the platform if an attacker uses a single IP to attempt brute-forcing many different user accounts.
Exponential Backoff Tiers:

Tier 1 (5 Failed Attempts): 60-second temporary cooldown (429 Too Many Requests).
Tier 2 (10 Failed Attempts): 15-minute extended security lockout (429 Too Many Requests) + dispatches AccountLockoutTriggered domain event.
Successful Login: Immediately resets failed attempt counters for both email and IP.
Proposed Changes
Core Response Helper (app/Http/Responses)
[MODIFY] 
ApiResponse.php
Enhance rateLimited(string $message, int $retryAfterSeconds = 60, array $extraMeta = []):
Adds retry_after to metadata and error payload.
Attaches standard HTTP Retry-After: {seconds} header to the response.
Central Auth Module (Modules/Auth)
[NEW] 
AccountLockoutTriggered.php
Domain event dispatched when an account enters Tier 2 (10+ failed attempts) extended security lockout.
Contains $email, $ipAddress, $failedAttempts, and $lockoutExpiresAt.
[NEW] 
BruteForceProtectionService.php
Encapsulates high-speed sliding-window rate tracking using Cache / Redis:
checkLockout(string $email, string $ip): ?array: Returns lockout metadata (remaining seconds, lockout level) or null if not locked.
recordFailedAttempt(string $email, string $ip): array: Increments failure counters, enforces 60s or 900s lockout, and fires AccountLockoutTriggered on Tier 2.
clearAttempts(string $email, string $ip): void: Resets attempt counters upon valid login.
[MODIFY] 
AuthController.php
In login():
Call BruteForceProtectionService::checkLockout(). If locked, immediately return ApiResponse::rateLimited(...) with remaining cooldown seconds.
If credentials fail (Hash::check fails or user not found), call BruteForceProtectionService::recordFailedAttempt().
If credentials succeed, call BruteForceProtectionService::clearAttempts() before issuing token.
[NEW] 
BruteForceLockoutTest.php
Test 1: User can attempt logins normally without lockout under threshold.
Test 2: 5 consecutive failed attempts trigger Tier 1 lockout (60s cooldown, HTTP 429, Retry-After: 60).
Test 3: Attempting login during Tier 1 cooldown is blocked even with correct password (429 Too Many Requests).
Test 4: Successful login clears failed attempt counters.
Test 5: 10 consecutive failed attempts trigger Tier 2 extended lockout (15 minutes cooldown, HTTP 429).
Test 6: Tier 2 lockout dispatches AccountLockoutTriggered domain event.
Test 7: Distributed attack protection: Target email is locked even if requests come from different simulated IPs.
Verification Plan
Automated Tests
Run the new Brute Force test suite and verify backwards compatibility:

bash

php artisan test Modules/Auth/tests/Feature/BruteForceLockoutTest.php
php artisan test Modules/Auth/tests/Feature
All tests must pass 100% green.

Master Checklist Update
Mark [x] TASK-009: Brute-Force Defense & Redis Lockout Engine as complete in 
docs/task/master_engineering_task_checklist.md
.
