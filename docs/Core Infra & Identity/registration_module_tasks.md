# Enterprise Registration Module: Implementation Tasks

এখানে আমাদের এন্টারপ্রাইজ রেজিস্ট্রেশন মডিউলের সম্পূর্ণ টাস্ক লিস্ট ট্র্যাক করা হবে। যেহেতু আমরা "Case Study" অ্যাপ্রোচে কাজ করছি, তাই প্রতিটি টাস্ক শেষ হওয়ার পর আমরা এখানে টিক [x] চিহ্ন দিয়ে আপডেট করবো।

## [x] Phase 1: Infrastructure (Docker & Load Balancer)
- [x] Create `docker-compose.yml` (MySQL, Redis, Nginx, 3x Laravel Nodes).
- [x] Create `nginx.conf` for Round-Robin Load Balancing on port 7000.

## [x] Phase 2: Database & Monitoring
- [x] Update `users` table migration to use UUID/ULID.
- [x] Install and configure `laravel/pulse` for real-time monitoring.
- [x] Setup Redis as the default cache and queue driver.

## [x] Phase 3: Core API & Security (AuthController)
- [x] Create `UserRegistered` event and background Listener (`ShouldQueue`).
- [x] Implement Device Fingerprinting & Rate Limiting (`throttle:5,1`).
- [x] Write `register` method with `DB::transaction` and Idempotency key logic.

## [x] Phase 4: Automated Testing (TDD)
- [x] Write `RegistrationTest.php`.
- [x] Add test for Idempotency & Race Conditions.
- [x] Add test for Rate Limiting (`HTTP 429`).

## [x] Phase 5: The Bot Army (Load Testing)
- [x] Create `tests/load_testing/locustfile.py`.
- [x] Execute 5,000 concurrent bot requests against the Nginx Load Balancer.
- [x] Monitor results on Laravel Pulse.
