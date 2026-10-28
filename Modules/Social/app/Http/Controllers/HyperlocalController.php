<?php

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Social\Services\HyperlocalFeedService;

class HyperlocalController extends Controller
{
    public function __construct(
        protected HyperlocalFeedService $hyperlocalService
    ) {}

    /**
     * Fetch neighborhood feed for a ward with optional thana expansion and cursor pagination.
     */
    public function feed(Request $request, string $wardCode): JsonResponse
    {
        $viewer = $request->user('sanctum');
        $perPage = (int) $request->query('per_page', 15);
        $cursor = $request->query('cursor');
        $postType = $request->query('post_type');
        $thanaCode = $request->query('thana_code');

        $result = $this->hyperlocalService->getWardFeed(
            wardCode: $wardCode,
            viewer: $viewer,
            perPage: $perPage,
            cursor: $cursor,
            postType: $postType,
            thanaCode: $thanaCode
        );

        $paginator = $result['paginator'];

        return ApiResponse::success(
            data: $paginator->items(),
            message: $result['is_expanded']
                ? "Showing broader {$result['thana_code']} community posts (ward feed empty)"
                : "Hyperlocal feed for ward {$wardCode} retrieved successfully",
            extraMeta: [
                'scope' => $result['scope'],
                'is_expanded' => $result['is_expanded'],
                'ward_code' => $result['ward_code'],
                'next_cursor' => $paginator->nextCursor()?->encode(),
                'prev_cursor' => $paginator->previousCursor()?->encode(),
                'has_more' => $paginator->hasMorePages(),
                'per_page' => $paginator->perPage(),
            ]
        );
    }

    /**
     * Fetch official civic notices and urgent announcements for a ward.
     */
    public function notices(Request $request, string $wardCode): JsonResponse
    {
        $viewer = $request->user('sanctum');
        $perPage = (int) $request->query('per_page', 15);
        $cursor = $request->query('cursor');

        $paginator = $this->hyperlocalService->getWardNotices(
            wardCode: $wardCode,
            viewer: $viewer,
            perPage: $perPage,
            cursor: $cursor
        );

        return ApiResponse::success(
            data: $paginator->items(),
            message: "Civic notices for ward {$wardCode} retrieved successfully",
            extraMeta: [
                'ward_code' => $wardCode,
                'next_cursor' => $paginator->nextCursor()?->encode(),
                'prev_cursor' => $paginator->previousCursor()?->encode(),
                'has_more' => $paginator->hasMorePages(),
                'per_page' => $paginator->perPage(),
            ]
        );
    }

    /**
     * Get neighborhood community pulse stats (posts, active neighbors, notices).
     */
    public function stats(string $wardCode): JsonResponse
    {
        $stats = $this->hyperlocalService->getWardPulseStats($wardCode);

        return ApiResponse::success(
            data: $stats,
            message: "Neighborhood pulse statistics for ward {$wardCode} retrieved successfully"
        );
    }
}
