# Implementation Plan - TASK-013: User Profiles & Follow/Friendship Graph

**Phase:** `PHASE 4: Consumer Social Media & Hyperlocal Feeds`  
**Task ID:** `TASK-013`  
**Governing Standards:** `CONST-001 (Principle 2: Data Ownership, Principle 6: Concurrency & Failure by Design)`

---

## Executive Summary & Architectural Overview

In **PHASE 4**, Zengfy expands into high-scale **Consumer Social Media and Hyperlocal Community Feeds** for 10M+ citizens across Bangladesh.

The foundational requirement of any social network is the **Social Graph**—the directed and undirected edges connecting users. In **TASK-013**, we architect the user profile and graph engine adhering to **Twitter / Instagram / Facebook high-concurrency design patterns**:
1. **Bidirectional vs. Unidirectional Graph Modeling:**
   - **Following (Unidirectional Edge):** User A follows User B (public figure/creator/friend) without mutual consent. Models one-way publication feeds.
   - **Friendship (Bidirectional Edge with State Machine):** User A requests friendship with User B. States: `pending` -> `accepted` (or `declined`, `blocked`). Mutual bond.
2. **Eliminating the Slow `COUNT(*)` Scaling Bottleneck via Cache Layering:**
   - On a 10M user database, executing `COUNT(*)` queries on every profile load causes devastating database connection exhaustion and latency spikes.
   - We implement **Redis Counter Cache Layering** (`user:{id}:followers_count`, `user:{id}:following_count`, `user:{id}:friends_count`) updated atomically with $O(1)$ fast retrieval, accompanied by persistent database counter columns.
3. **Hyperlocal Profile Fields (Preparation for TASK-015):**
   - Adding `handle` (unique @username), `bio`, `ward_code`, `thana_code`, `district_code`, and privacy settings.
4. **SocialGraphService:**
   - Encapsulates graph operations, validation (preventing self-follows, duplicate requests), and atomic counter synchronization.
5. **Zero-Trust RESTful API Endpoints & 100% Automated Feature Test Suite:**
   - Full CRUD on profiles, follows, and friendships with 100% test coverage.

---

## User Review Required

> [!IMPORTANT]
> **Graph Storage Strategy (Relational SQL + Redis Counters vs Dedicated Graph DB):**  
> Following `CONST-001 (Principle 1: Modular Monolith First)`, we avoid introducing Neo4j or complex graph databases prematurely. A clean relational schema with composite compound indexes (`[follower_id, following_id]`, `[sender_id, receiver_id]`) paired with Redis counters scales smoothly past 10M users at zero additional infrastructure overhead.

> [!NOTE]
> All graph tables strictly enforce Universal UUID primary and foreign keys via `HasUuids`.

---

## Proposed Changes

### 1. Domain Registration & Module Configuration

#### [MODIFY] [`modules_statuses.json`](file:///p:/Zengfy-Ecosystem/core/modules_statuses.json)
- Register `"Social": true`.

#### [MODIFY] [`composer.json`](file:///p:/Zengfy-Ecosystem/core/composer.json)
- Add PSR-4 mappings for `Modules\\Social\\` -> `Modules/Social/app/`.

---

### 2. Database Migrations (`Modules/Social/database/migrations`)

#### [NEW] `2026_09_23_000030_add_social_profile_fields_to_users_table.php`
- Add to `users` table:
  - `handle`: string unique nullable (indexed)
  - `bio`: text nullable
  - `ward_code`: string nullable (indexed for hyperlocal feeds)
  - `thana_code`: string nullable
  - `district_code`: string nullable
  - `followers_count`: integer default 0
  - `following_count`: integer default 0
  - `friends_count`: integer default 0
  - `is_private`: boolean default false

#### [NEW] `2026_09_23_000031_create_follows_table.php`
- `id`: UUID Primary Key
- `follower_id`: foreign UUID -> `users(id)` cascade on delete
- `following_id`: foreign UUID -> `users(id)` cascade on delete
- timestamps
- Unique constraint: `['follower_id', 'following_id']`
- Composite index: `['following_id', 'created_at']` (for paginating followers)
- Composite index: `['follower_id', 'created_at']` (for paginating following)

#### [NEW] `2026_09_23_000032_create_friendships_table.php`
- `id`: UUID Primary Key
- `sender_id`: foreign UUID -> `users(id)` cascade on delete
- `receiver_id`: foreign UUID -> `users(id)` cascade on delete
- `status`: string (`pending`, `accepted`, `declined`, `blocked`)
- timestamps
- Unique constraint: `['sender_id', 'receiver_id']`
- Index: `['receiver_id', 'status']`
- Index: `['sender_id', 'status']`

---

### 3. Core Models & Services (`Modules/Social/app`)

#### [NEW] `Modules/Social/app/Models/Follow.php`
- Uses `HasUuids`.
- Relationships: `follower()`, `following()`.

#### [NEW] `Modules/Social/app/Models/Friendship.php`
- Uses `HasUuids`.
- Relationships: `sender()`, `receiver()`.
- Scopes: `accepted()`, `pending()`.

#### [NEW] `Modules/Social/app/Services/SocialGraphService.php`
- Graph operations:
  - `follow(User $follower, User $target): bool`
  - `unfollow(User $follower, User $target): bool`
  - `sendFriendRequest(User $sender, User $receiver): Friendship`
  - `acceptFriendRequest(string $friendshipId, User $receiver): Friendship`
  - `declineFriendRequest(string $friendshipId, User $receiver): Friendship`
  - `removeFriend(User $userA, User $userB): bool`
  - `getCounts(User $user): array` (Cached in Redis, $O(1)$)
  - `isFollowing(User $user, User $target): bool`
  - `getFriendshipStatus(User $userA, User $userB): ?string`

#### [NEW] `Modules/Social/app/Traits/HasSocialGraph.php`
- Trait for `User` model:
  - `followers()`, `following()`, `friendshipsSent()`, `friendshipsReceived()`
  - Convenient helper methods: `isFollowing()`, `isFriendsWith()`

#### [MODIFY] [`app/Models/User.php`](file:///p:/Zengfy-Ecosystem/core/app/Models/User.php)
- Include `HasSocialGraph` trait and new fillable fields (`handle`, `bio`, `ward_code`, `followers_count`, etc.).

---

### 4. HTTP Layer & API Controllers

#### [NEW] `Modules/Social/app/Http/Controllers/ProfileController.php`
- `show(string $handleOrId)`: Fetch public profile with cached graph counters and viewer relation status.
- `update(Request $request)`: Update bio, avatar, handle, and hyperlocal ward info.

#### [NEW] `Modules/Social/app/Http/Controllers/FollowController.php`
- `follow(Request $request, string $id)`: Follow a user ($O(1)$ counter increment).
- `unfollow(Request $request, string $id)`: Unfollow a user ($O(1)$ counter decrement).
- `followers(string $id)`: Paginated list of followers.
- `following(string $id)`: Paginated list of following.

#### [NEW] `Modules/Social/app/Http/Controllers/FriendshipController.php`
- `sendRequest(Request $request, string $id)`: Send friend request.
- `acceptRequest(string $id)`: Accept pending friend request.
- `declineRequest(string $id)`: Decline pending friend request.
- `friends(string $id)`: Paginated list of mutual friends.
- `pendingRequests(Request $request)`: List incoming friend requests.

#### [MODIFY] [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
- Mount social routes under `/api/v1/social` and `/api/v1/users`.

#### [MODIFY] [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml)
- Document all profile and social graph endpoints in OpenAPI 3.1.

---

## Verification Plan

### Automated Feature Tests
[`Modules/Social/tests/Feature/SocialGraphTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/tests/Feature/SocialGraphTest.php)

Assertions to verify:
1. `test_user_can_update_profile_and_unique_handle()`
2. `test_user_can_follow_another_user_and_counters_increment_atomically()`
3. `test_user_cannot_follow_self()`
4. `test_user_can_unfollow_and_counters_decrement()`
5. `test_user_can_send_friend_request()`
6. `test_duplicate_or_reverse_friend_request_is_prevented()`
7. `test_receiver_can_accept_friend_request_and_both_become_friends()`
8. `test_receiver_can_decline_friend_request()`
9. `test_public_profile_endpoint_returns_accurate_relationship_state_and_cached_counts()`
10. `test_followers_and_following_lists_are_paginated()`

### Execution Command
```bash
php artisan test Modules/Social/tests/Feature
php artisan test Modules/Auth/tests/Feature Modules/Organization/tests/Feature
```
Target: 100% Passing with zero regressions (60+ tests total).
