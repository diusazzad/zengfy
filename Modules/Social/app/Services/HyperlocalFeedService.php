<?php

namespace Modules\Social\Services;

use App\Models\User;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Support\Facades\Cache;
use Modules\Social\Models\Post;

class HyperlocalFeedService
{
    protected const STATS_CACHE_TTL = 300; // 5 minutes

    /**
     * Get hyperlocal feed for a specific ward with optional expansion and cursor pagination.
     */
    public function getWardFeed(
        string $wardCode,
        ?User $viewer = null,
        int $perPage = 15,
        ?string $cursor = null,
        ?string $postType = null,
        ?string $thanaCode = null
    ): array {
        $perPage = min(max($perPage, 1), 50);

        $query = Post::with(['user:id,name,handle,avatar,verified_badge,ward_code', 'media'])
            ->visibleTo($viewer)
            ->where('ward_code', $wardCode);

        if ($postType) {
            $query->where('post_type', $postType);
        }

        $paginator = $query->orderByDesc('created_at')
            ->orderByDesc('id')
            ->cursorPaginate($perPage, ['*'], 'cursor', $cursor);

        $isExpanded = false;

        // If ward has no posts on initial page load and a thana code is provided, fallback to thana level
        if ($paginator->isEmpty() && !$cursor && $thanaCode) {
            $thanaQuery = Post::with(['user:id,name,handle,avatar,verified_badge,ward_code', 'media'])
                ->visibleTo($viewer)
                ->where('thana_code', $thanaCode);

            if ($postType) {
                $thanaQuery->where('post_type', $postType);
            }

            $paginator = $thanaQuery->orderByDesc('created_at')
                ->orderByDesc('id')
                ->cursorPaginate($perPage, ['*'], 'cursor', $cursor);

            $isExpanded = true;
        }

        return [
            'paginator' => $paginator,
            'is_expanded' => $isExpanded,
            'scope' => $isExpanded ? 'thana' : 'ward',
            'ward_code' => $wardCode,
            'thana_code' => $thanaCode,
        ];
    }

    /**
     * Fetch urgent notices, civic advisories, and administrative announcements for a ward.
     */
    public function getWardNotices(
        string $wardCode,
        ?User $viewer = null,
        int $perPage = 15,
        ?string $cursor = null
    ): CursorPaginator {
        $perPage = min(max($perPage, 1), 50);

        return Post::with(['user:id,name,handle,avatar,verified_badge,ward_code', 'media'])
            ->visibleTo($viewer)
            ->where('ward_code', $wardCode)
            ->whereIn('post_type', ['announcement', 'hyperlocal_notice'])
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->cursorPaginate($perPage, ['*'], 'cursor', $cursor);
    }

    /**
     * Get aggregate community pulse statistics for a neighborhood ward.
     */
    public function getWardPulseStats(string $wardCode): array
    {
        return Cache::remember("ward:pulse:{$wardCode}", self::STATS_CACHE_TTL, function () use ($wardCode) {
            $totalPosts = Post::where('ward_code', $wardCode)->count();
            $noticesCount = Post::where('ward_code', $wardCode)
                ->whereIn('post_type', ['announcement', 'hyperlocal_notice'])
                ->count();
            $activeContributors = Post::where('ward_code', $wardCode)
                ->distinct('user_id')
                ->count('user_id');

            return [
                'ward_code' => $wardCode,
                'total_posts' => $totalPosts,
                'notices_count' => $noticesCount,
                'active_neighbors_count' => $activeContributors,
            ];
        });
    }
}
