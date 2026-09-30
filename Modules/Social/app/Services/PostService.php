<?php

namespace Modules\Social\Services;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Modules\Social\Models\Post;
use Modules\Social\Models\PostMedia;

class PostService
{
    /**
     * Create a new social post with optional media attachments.
     */
    public function createPost(User $user, array $data): Post
    {
        $content = isset($data['content']) ? trim((string) $data['content']) : null;
        $mediaItems = $data['media'] ?? [];

        if (empty($content) && empty($mediaItems)) {
            throw new InvalidArgumentException('Post must contain text content or at least one media item.');
        }

        return DB::transaction(function () use ($user, $data, $content, $mediaItems) {
            $post = Post::create([
                'user_id' => $user->id,
                'content' => $content,
                'post_type' => $data['post_type'] ?? 'standard',
                'visibility' => $data['visibility'] ?? 'public',
                'ward_code' => $data['ward_code'] ?? $user->ward_code,
                'thana_code' => $data['thana_code'] ?? $user->thana_code,
                'district_code' => $data['district_code'] ?? $user->district_code,
                'is_pinned' => (bool) ($data['is_pinned'] ?? false),
            ]);

            if (!empty($mediaItems)) {
                $mediaRecords = [];
                foreach ($mediaItems as $index => $item) {
                    $mediaRecords[] = [
                        'id' => (string) \Illuminate\Support\Str::uuid(),
                        'post_id' => $post->id,
                        'media_type' => $item['media_type'] ?? 'image',
                        'url' => $item['url'],
                        'storage_path' => $item['storage_path'] ?? $item['url'],
                        'mime_type' => $item['mime_type'] ?? 'image/jpeg',
                        'file_size_bytes' => (int) ($item['file_size_bytes'] ?? 0),
                        'width' => isset($item['width']) ? (int) $item['width'] : null,
                        'height' => isset($item['height']) ? (int) $item['height'] : null,
                        'order_column' => $item['order_column'] ?? $index,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                PostMedia::insert($mediaRecords);
            }

            return $post->load([
                'user:id,name,handle,avatar,verified_badge,ward_code',
                'media',
            ]);
        });
    }

    /**
     * Delete a post.
     */
    public function deletePost(User $user, Post $post): bool
    {
        if ($post->user_id !== $user->id && !$user->hasRole('admin')) {
            throw new AuthorizationException('You are not authorized to delete this post.');
        }

        return (bool) $post->delete();
    }

    /**
     * Get a single post by ID if visible to viewer.
     */
    public function getPostById(string $id, ?User $viewer = null): ?Post
    {
        return Post::with(['user:id,name,handle,avatar,verified_badge,ward_code', 'media'])
            ->visibleTo($viewer)
            ->where('id', $id)
            ->first();
    }

    /**
     * Fetch timeline feed using keyset/cursor pagination for $O(1)$ infinite scroll.
     */
    public function getPublicFeed(?User $viewer = null, int $perPage = 15, ?string $cursor = null): CursorPaginator
    {
        $perPage = min(max($perPage, 1), 50);

        return Post::with(['user:id,name,handle,avatar,verified_badge,ward_code', 'media'])
            ->visibleTo($viewer)
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->cursorPaginate($perPage, ['*'], 'cursor', $cursor);
    }

    /**
     * Fetch all posts created by a specific user.
     */
    public function getUserPosts(User $targetUser, ?User $viewer = null, int $perPage = 15, ?string $cursor = null): CursorPaginator
    {
        $perPage = min(max($perPage, 1), 50);

        return Post::with(['user:id,name,handle,avatar,verified_badge,ward_code', 'media'])
            ->where('user_id', $targetUser->id)
            ->visibleTo($viewer)
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->cursorPaginate($perPage, ['*'], 'cursor', $cursor);
    }

    /**
     * Fetch hyperlocal feed filtered by ward code.
     */
    public function getHyperlocalFeed(string $wardCode, ?User $viewer = null, int $perPage = 15, ?string $cursor = null): CursorPaginator
    {
        $perPage = min(max($perPage, 1), 50);

        return Post::with(['user:id,name,handle,avatar,verified_badge,ward_code', 'media'])
            ->where('ward_code', $wardCode)
            ->visibleTo($viewer)
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->cursorPaginate($perPage, ['*'], 'cursor', $cursor);
    }
}
