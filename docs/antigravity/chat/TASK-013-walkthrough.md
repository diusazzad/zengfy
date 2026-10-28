# Walkthrough - TASK-013: User Profiles & Follow/Friendship Graph

**Phase:** `PHASE 4: Consumer Social Media & Hyperlocal Feeds`  
**Milestone:** `TASK-013: User Profiles & Follow/Friendship Graph`  
**Status:** 🟢 **COMPLETED & 100% PASSING (11/11 Tests)**  
**Overall Module Test Baseline:** `61/61 Feature Tests Passing (311 Assertions)` across Auth, Organization, and Social modules.

---

## 🏛️ High-Level Architectural Summary

In **TASK-013**, we architected and implemented the core social graph layer connecting users across Bangladesh. Inspired by **Twitter / Instagram / Facebook high-concurrency patterns**, the system combines:

1. **Unidirectional Graph (Following):** One-way follow edge without mutual consent.
2. **Bidirectional Graph (Friendship):** Mutual bond governed by a formal state machine (`pending` -> `accepted` / `declined` / `blocked`).
3. **Atomic Redis Counter Cache ($O(1)$ Complexity):** Eliminating destructive `COUNT(*)` SQL table scans on high-traffic profile views through Redis atomic `INCR` / `DECR` paired with persistent database counter columns.
4. **Hyperlocal Geospatial Attributes:** User profile fields for `ward_code`, `thana_code`, and `district_code` to empower hyperlocal neighborhood feeds.

```
                     ┌────────────────────────────────────────┐
                     │          Client / Mobile App           │
                     └───────────────────┬────────────────────┘
                                         │
                        GET /api/v1/users/{handle_or_id}
                                         │
                                         ▼
                     ┌────────────────────────────────────────┐
                     │      ProfileController::show()         │
                     └───────────────────┬────────────────────┘
                                         │
                                         ▼
                     ┌────────────────────────────────────────┐
                     │       SocialGraphService::getCounts    │
                     └───────────────┬────────────────┬───────┘
                                     │                │
                         Cache HIT ($O(1))       Cache MISS
                                     │                │
                                     ▼                ▼
                            ┌────────────────┐ ┌────────────────┐
                            │  Redis Cache   │ │ Read DB Column │
                            │ (1 millisecond)│ │ & Prime Cache  │
                            └────────────────┘ └────────────────┘
```

---

## 🛠️ Changes Implemented

### 1. Module Registration & Autoloading
- [`modules_statuses.json`](file:///p:/Zengfy-Ecosystem/core/modules_statuses.json): Registered `"Social": true`.
- [`composer.json`](file:///p:/Zengfy-Ecosystem/core/composer.json): Added PSR-4 autoloading for `"Modules\\Social\\": "Modules/Social/app/"`.

### 2. Database Migrations (`Modules/Social/database/migrations`)
- `2026_09_23_000030_add_social_profile_fields_to_users_table.php`:
  - Added unique `handle`, `bio`, `ward_code`, `thana_code`, `district_code`, `followers_count`, `following_count`, `friends_count`, and `is_private`.
- `2026_09_23_000031_create_follows_table.php`:
  - UUID primary key, `follower_id`, `following_id` with foreign key cascades, unique constraint on `[follower_id, following_id]`, and composite pagination indexes.
- `2026_09_23_000032_create_friendships_table.php`:
  - UUID primary key, `sender_id`, `receiver_id`, `status` (`pending`, `accepted`, `declined`, `blocked`), unique constraint on `[sender_id, receiver_id]`, and indexed status lookups.

### 3. Models, Services & Traits (`Modules/Social/app`)
- [`Follow.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Models/Follow.php): Eloquent model with `HasUuids`, relationships `follower()` and `following()`.
- [`Friendship.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Models/Friendship.php): Eloquent model with `HasUuids`, relationships `sender()` and `receiver()`, query scopes `scopeAccepted()` and `scopePending()`.
- [`SocialGraphService.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Services/SocialGraphService.php):
  - `follow()` & `unfollow()`: Database atomic transactions + Redis counter updates.
  - `sendFriendRequest()`: Duplicate and reverse-request checks.
  - `acceptFriendRequest()` & `declineFriendRequest()`: State transitions with atomic mutual friend counter updates.
  - `removeFriend()`: Handles bidirectional mutual friend termination.
  - `getCounts()`: Redis-cached $O(1)$ counter layer with automatic DB column fallback.
  - `getFriendshipStatus()` & `isFollowing()`: Fast relationship state checks.
- [`HasSocialGraph.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Traits/HasSocialGraph.php): Integrated into [`User.php`](file:///p:/Zengfy-Ecosystem/core/app/Models/User.php) exposing relationships (`followers`, `following`, `friendshipsSent`, `friendshipsReceived`) and helper methods (`isFollowing()`, `isFriendsWith()`).

### 4. HTTP Layer & API Endpoints
- [`ProfileController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Http/Controllers/ProfileController.php):
  - `GET /api/v1/users/{id}`: Returns public profile, cached follower/following/friend counts, and viewer relationship state (`is_following`, `friendship_status`).
  - `PUT /api/v1/profile`: Updates bio, handle (sanitizing `@` prefixes), and hyperlocal ward/thana/district codes.
- [`FollowController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Http/Controllers/FollowController.php):
  - `POST /api/v1/users/{id}/follow`: Follows target user (preventing self-follows).
  - `DELETE /api/v1/users/{id}/follow`: Unfollows target user.
  - `GET /api/v1/users/{id}/followers`: Paginated follower list.
  - `GET /api/v1/users/{id}/following`: Paginated following list.
- [`FriendshipController.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/app/Http/Controllers/FriendshipController.php):
  - `POST /api/v1/users/{id}/friend-request`: Sends friend request.
  - `POST /api/v1/friend-requests/{id}/accept`: Accepts friend request.
  - `POST /api/v1/friend-requests/{id}/decline`: Declines friend request.
  - `DELETE /api/v1/users/{id}/friend`: Removes mutual friend.
  - `GET /api/v1/users/{id}/friends`: Paginated list of mutual friends.
  - `GET /api/v1/friend-requests/pending`: Paginated incoming requests.
- [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php): Mounted all social graph routes under `/api/v1/users`, `/api/v1/profile`, and `/api/v1/friend-requests`.
- [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml): Documented all social graph endpoints in OpenAPI 3.1.

---

## 🧪 Verification & Automated Test Evidence

Executed command:
```bash
php artisan test Modules/Social/tests/Feature/SocialGraphTest.php
```

Output:
```text
   PASS  Modules\Social\Tests\Feature\SocialGraphTest
  ✓ user can update profile and unique handle                                    0.11s  
  ✓ user can follow another user and counters increment atomically               0.08s  
  ✓ user cannot follow self                                                      0.06s  
  ✓ user can unfollow and counters decrement                                     0.07s  
  ✓ user can send friend request                                                 0.07s  
  ✓ duplicate friend request is prevented                                        0.07s  
  ✓ receiver can accept friend request and both become friends                   0.09s  
  ✓ receiver can decline friend request                                          0.07s  
  ✓ user can remove mutual friend                                                0.08s  
  ✓ public profile endpoint returns accurate relationship state and cached counts 0.08s  
  ✓ followers and following lists are paginated                                  0.12s  

  Tests:    11 passed (46 assertions)
  Duration: 2.10s
```

Full Module Verification across Identity, Multi-Tenancy & Social:
```bash
php artisan test Modules/Auth/tests/Feature Modules/Organization/tests/Feature Modules/Social/tests/Feature
```

Output:
```text
  Tests:    61 passed (311 assertions)
  Duration: 5.90s
```
