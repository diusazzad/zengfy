# Implementation Plan - TASK-014: Post Creation, Media Attachments & Cursor Pagination

**Phase:** `PHASE 4: Consumer Social Media & Hyperlocal Feeds`  
**Task ID:** `TASK-014`  
**Governing Standards:** `CONST-001 (Principle 1: Modular Monolith, Principle 2: Data Ownership & UUIDs, Principle 6: Concurrency & Failure by Design)`

---

## Executive Summary & Architectural Overview

In **TASK-014**, we build the core content publishing and timeline consumption engine for Zengfy at 10M+ scale.

### 1. The Scaling Problem with Traditional Offset Pagination
In relational databases, querying feeds using offset pagination (`SELECT * FROM posts ORDER BY created_at DESC LIMIT 20 OFFSET 50000`) forces MySQL to read, sort, and discard 50,000 index rows on every request. On a 10M-row table, this results in:
- Exponential query latency spikes (from 5ms on page 1 to 1,200ms+ on page 500).
- Buffer pool cache thrashing.
- **Page Drift / Duplicate items:** As new posts are published, page offsets shift dynamically, causing users to see duplicate posts or miss posts while scrolling down.

#### 🚀 Solution: Keyset / Cursor-Based Pagination
We implement **Keyset Cursor Pagination**:
```sql
SELECT * FROM posts 
WHERE (created_at, id) < (:cursor_created_at, :cursor_id) 
ORDER BY created_at DESC, id DESC 
LIMIT 20;
```
By indexing `(created_at, id)` as a composite B-Tree index, the database jumps directly to the cursor position in $O(1)$ constant time regardless of feed depth. The cursor is base64-encoded to client applications as an opaque token (`next_cursor`).

---

### 2. High-Concurrency Media Ingestion (S3 / MinIO Presigned Direct Upload)
Allowing users to upload large images/videos directly through PHP-FPM web workers ties up worker processes for seconds during slow 3G/4G connections, quickly leading to 504 Gateway Timeouts.

#### 🚀 Solution: Presigned Direct Upload Flow
1. Client requests a presigned upload URL: `POST /api/v1/media/presign` with `filename`, `mime_type`, and `size_bytes`.
2. Backend validates file type and size constraints, generates a unique storage key (`media/posts/{uuid}.jpg`), and issues a signed S3/MinIO upload URL with a 15-minute expiration.
3. Client uploads the binary directly to MinIO/S3.
4. Client creates the post: `POST /api/v1/posts` referencing the uploaded media keys.
5. Backend verifies metadata and links the media records to the post inside an atomic transaction.

---

## User Review Required

> [!IMPORTANT]
> **Universal UUID Invariants:**  
> In accordance with `CONST-001`, all new tables (`posts`, `post_media`) use Universal UUID primary keys and foreign keys. Composite indexing on `['created_at', 'id']` ensures high-throughput cursor pagination without integer auto-increments.

> [!NOTE]
> For local testing and development environments where MinIO may be offline, our `MediaStorageService` provides seamless fallback to standard file storage while maintaining full compatibility with the presigned direct-upload API contract.

---

## Proposed Changes

### 1. Database Migrations (`Modules/Social/database/migrations`)

#### [NEW] `2026_09_23_000033_create_posts_table.php`
- `id`: UUID Primary Key (`HasUuids`)
- `user_id`: foreign UUID -> `users(id)` cascade on delete
- `content`: text nullable (allows media-only, text-only, or combined)
- `post_type`: string default `'standard'` (`standard`, `announcement`, `poll`, `hyperlocal_notice`)
- `visibility`: string default `'public'` (`public`, `friends_only`, `private`)
- `ward_code`: string nullable (indexed for hyperlocal feeds in TASK-015)
- `thana_code`: string nullable
- `district_code`: string nullable
- `likes_count`: integer default 0
- `comments_count`: integer default 0
- `shares_count`: integer default 0
- `is_pinned`: boolean default false
- timestamps
- Composite index: `['user_id', 'created_at']` (for user profile timeline)
- Composite index: `['created_at', 'id']` (for global & cursor feed pagination)
- Composite index: `['ward_code', 'created_at']` (for hyperlocal news feeds)

#### [NEW] `2026_09_23_000034_create_post_media_table.php`
- `id`: UUID Primary Key (`HasUuids`)
- `post_id`: foreign UUID -> `posts(id)` cascade on delete
- `media_type`: string (`image`, `video`, `document`)
- `url`: string
- `storage_path`: string
- `mime_type`: string
- `file_size_bytes`: unsigned big integer
- `width`: integer nullable
- `height`: integer nullable
- `order_column`: integer default 0
- timestamps
- Index: `['post_id', 'order_column']`

---

### 2. Core Models & Services (`Modules/Social/app`)

#### [NEW] `Modules/Social/app/Models/Post.php`
- Uses `HasUuids`.
- Relationships:
  - `user()`: BelongsTo `User`
  - `media()`: HasMany `PostMedia` ordered by `order_column`
- Query Scopes:
  - `publicVisibility()`
  - `hyperlocal(string $wardCode)`

#### [NEW] `Modules/Social/app/Models/PostMedia.php`
- Uses `HasUuids`.
- Relationships: `post()`: BelongsTo `Post`.

#### [NEW] `Modules/Social/app/Services/MediaStorageService.php`
- Validates MIME types (JPEG, PNG, WEBP, MP4, PDF) and max size (10MB for photos, 50MB for videos).
- `generatePresignedUploadUrl(string $mimeType, int $sizeBytes): array`
- Generates S3/MinIO presigned PUT URLs or local mock signed URLs with secure expiring HMAC signatures.

#### [NEW] `Modules/Social/app/Services/PostService.php`
- Encapsulates post creation within atomic DB transactions (`createPost(User $author, array $data, array $media = []): Post`).
- Handles post deletion and authorization (`deletePost(User $user, Post $post): bool`).
- Cursor-paginated timeline queries:
  - `getPublicFeed(?string $cursor = null, int $perPage = 20): CursorPaginator`
  - `getUserTimeline(User $user, ?string $cursor = null, int $perPage = 20): CursorPaginator`

---

### 3. HTTP Layer & API Endpoints

#### [NEW] `Modules/Social/app/Http/Controllers/MediaController.php`
- `POST /api/v1/media/presign`: Request presigned upload URL and storage key.

#### [NEW] `Modules/Social/app/Http/Controllers/PostController.php`
- `POST /api/v1/posts`: Create a new post with content, hyperlocal ward tag, and media attachments.
- `GET /api/v1/posts/{id}`: View single post with author details and media.
- `DELETE /api/v1/posts/{id}`: Delete own post (403 for unauthorized users).
- `GET /api/v1/feed`: Public cursor-paginated feed with `next_cursor` metadata.
- `GET /api/v1/users/{id}/posts`: User-specific cursor-paginated post timeline.

#### [MODIFY] [`routes/api.php`](file:///p:/Zengfy-Ecosystem/core/routes/api.php)
- Mount `/api/v1/posts`, `/api/v1/feed`, and `/api/v1/media/presign` protected by `auth:sanctum`.

#### [MODIFY] [`docs/api/openapi.yaml`](file:///p:/Zengfy-Ecosystem/core/docs/api/openapi.yaml)
- Document all post creation, media presign, and cursor feed endpoints in OpenAPI 3.1.

---

## Verification Plan

### Automated Feature Tests
[`Modules/Social/tests/Feature/PostCreationAndPaginationTest.php`](file:///p:/Zengfy-Ecosystem/core/Modules/Social/tests/Feature/PostCreationAndPaginationTest.php)

Asserting:
1. `test_user_can_request_presigned_media_upload_url()`
2. `test_user_can_create_text_only_post()`
3. `test_user_can_create_post_with_multiple_media_attachments()`
4. `test_post_creation_fails_with_empty_content_and_no_media()`
5. `test_user_can_view_single_post_with_author_and_media()`
6. `test_author_can_delete_own_post()`
7. `test_user_cannot_delete_another_users_post()`
8. `test_feed_uses_cursor_pagination_and_returns_opaque_tokens()`
9. `test_cursor_pagination_navigates_to_next_page_without_duplicate_posts()`
10. `test_user_timeline_returns_only_specific_users_posts()`

### Execution Command
```bash
php artisan test Modules/Social/tests/Feature/PostCreationAndPaginationTest.php
php artisan test Modules/Auth/tests/Feature Modules/Organization/tests/Feature Modules/Social/tests/Feature
```
Target: 100% Passing with zero regressions (70+ tests total).
