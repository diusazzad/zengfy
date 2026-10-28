<?php

namespace Modules\Social\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Social\Models\Follow;
use Modules\Social\Models\Friendship;
use Modules\Social\Models\Post;
use Modules\Social\Models\PostMedia;

class PostService
{
    /**
     * Create a new post along with media.
     */
    public function createPost(User $author, array $data, array $uploadedFiles = []): Post
    {
        return DB::transaction(function () use ($author, $data, $uploadedFiles) {
            $post = Post::create([
                'user_id' => $author->id,
                'content' => $data['content'] ?? null,
                'post_type' => $data['post_type'] ?? 'standard',
                'visibility' => $data['visibility'] ?? 'public',
                'ward_code' => $data['ward_code'] ?? $author->ward_code,
                'thana_code' => $data['thana_code'] ?? null,
                'district_code' => $data['district_code'] ?? null,
                'is_pinned' => $data['is_pinned'] ?? false,
            ]);

            // Handle direct file uploads (multipart)
            if (!empty($uploadedFiles)) {
                $order = 0;
                foreach ($uploadedFiles as $file) {
                    if ($file instanceof UploadedFile && $file->isValid()) {
                        $path = $file->store("social/posts/{$post->id}", 'public');
                        PostMedia::create([
                            'post_id' => $post->id,
                            'url' => Storage::disk('public')->url($path),
                            'storage_path' => $path,
                            'media_type' => str_starts_with($file->getMimeType(), 'video/') ? 'video' : 'image',
                            'mime_type' => $file->getMimeType(),
                            'file_size_bytes' => $file->getSize(),
                            'order_column' => $order++,
                        ]);
                    }
                }
            }

            // Handle pre-signed/already uploaded media descriptors
            if (!empty($data['media']) && is_array($data['media'])) {
                foreach ($data['media'] as $mediaItem) {
                    PostMedia::create([
                        'post_id' => $post->id,
                        'url' => $mediaItem['url'],
                        'storage_path' => $mediaItem['storage_path'] ?? null,
                        'media_type' => $mediaItem['media_type'] ?? 'image',
                        'mime_type' => $mediaItem['mime_type'] ?? null,
                        'file_size_bytes' => $mediaItem['file_size_bytes'] ?? null,
                        'width' => $mediaItem['width'] ?? null,
                        'height' => $mediaItem['height'] ?? null,
                        'order_column' => $mediaItem['order_column'] ?? 0,
                    ]);
                }
            }

            return $post->load(['user', 'media']);
        });
    }

    /**
     * Delete a post and its associated media files from storage.
     */
    public function deletePost(User $user, Post $post): bool
    {
        if ($post->user_id !== $user->id) {
            throw new \Illuminate\Auth\Access\AuthorizationException('Unauthorized to delete this post.');
        }

        return DB::transaction(function () use ($post) {
            foreach ($post->media as $media) {
                if ($media->storage_path && Storage::disk('public')->exists($media->storage_path)) {
                    Storage::disk('public')->delete($media->storage_path);
                }
            }

            return (bool) $post->delete();
        });
    }

    /**
     * Get a single post by ID if viewer has permission.
     */
    public function getPostById(string $id, ?User $viewer = null): ?Post
    {
        return Post::with(['user:id,name,handle,avatar,verified_badge,ward_code', 'media'])
            ->visibleTo($viewer)
            ->find($id);
    }

    /**
     * Fetch timeline feed using keyset/cursor pagination for $O(1)$ infinite scroll.
     * Supports 4 dynamic streams: 'world' (default), 'friends', 'community', and 'nearby'.
     */
    public function getPublicFeed(?User $viewer = null, int $perPage = 15, ?string $cursor = null, ?string $filter = null, ?string $wardCode = null): CursorPaginator
    {
        $perPage = min(max($perPage, 1), 50);

        $query = Post::with(['user:id,name,handle,avatar,verified_badge,ward_code', 'media'])
            ->visibleTo($viewer);

        if ($filter === 'community') {
            $query->whereIn('post_type', ['civic_notice', 'announcement', 'community', 'hyperlocal_notice']);
        } elseif ($filter === 'friends') {
            if ($viewer) {
                $followingIds = Follow::where('follower_id', $viewer->id)->pluck('followed_id')->toArray();
                $friendIds = Friendship::where(function ($q) use ($viewer) {
                    $q->where('user_id', $viewer->id)->orWhere('friend_id', $viewer->id);
                })->where('status', 'accepted')->get()->map(function ($f) use ($viewer) {
                    return $f->user_id == $viewer->id ? $f->friend_id : $f->user_id;
                })->toArray();
                $allowedUserIds = array_unique(array_merge([$viewer->id], $followingIds, $friendIds));
                $query->whereIn('user_id', $allowedUserIds);
            } else {
                $query->whereRaw('0 = 1');
            }
        } elseif ($filter === 'nearby') {
            $ward = $wardCode ?: (request()->query('ward_code') ?: ($viewer?->ward_code ?: 'WARD-DHAKA-19'));
            $query->where('ward_code', $ward);
        }

        return $query
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
