<?php

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Modules\Social\Models\Post;
use Modules\Social\Services\PostService;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function __construct(
        protected PostService $postService
    ) {}

    /**
     * Create a new social post.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'content' => ['nullable', 'string', 'max:10000'],
            'post_type' => ['sometimes', 'string', 'in:standard,announcement,poll,hyperlocal_notice'],
            'visibility' => ['sometimes', 'string', 'in:public,friends_only,private'],
            'ward_code' => ['nullable', 'string', 'max:20'],
            'thana_code' => ['nullable', 'string', 'max:50'],
            'district_code' => ['nullable', 'string', 'max:50'],
            'is_pinned' => ['sometimes', 'boolean'],
            'media' => ['sometimes', 'array', 'max:10'],
            'media.*.url' => ['required_with:media', 'string', 'max:2048'],
            'media.*.storage_path' => ['sometimes', 'string', 'max:255'],
            'media.*.media_type' => ['sometimes', 'string', 'in:image,video,document'],
            'media.*.mime_type' => ['sometimes', 'string', 'max:100'],
            'media.*.file_size_bytes' => ['sometimes', 'integer', 'min:0'],
            'media.*.width' => ['nullable', 'integer'],
            'media.*.height' => ['nullable', 'integer'],
            'media.*.order_column' => ['nullable', 'integer'],
        ]);

        try {
            $post = $this->postService->createPost($request->user(), $validated);

            return ApiResponse::created($post, 'Post created successfully');
        } catch (InvalidArgumentException $e) {
            return ApiResponse::error(
                message: $e->getMessage(),
                statusCode: Response::HTTP_UNPROCESSABLE_ENTITY,
                errorCode: 'EMPTY_POST'
            );
        }
    }

    /**
     * View a single post.
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $viewer = $request->user('sanctum');
        $post = $this->postService->getPostById($id, $viewer);

        if (!$post) {
            return ApiResponse::notFound('Post not found or you do not have permission to view it.');
        }

        return ApiResponse::success($post, 'Post retrieved successfully');
    }

    /**
     * Delete a post.
     */
    public function destroy(Request $request, string $id): JsonResponse
    {
        $post = Post::find($id);

        if (!$post) {
            return ApiResponse::notFound('Post not found.');
        }

        try {
            $this->postService->deletePost($request->user(), $post);

            return ApiResponse::success(null, 'Post deleted successfully');
        } catch (AuthorizationException $e) {
            return ApiResponse::forbidden($e->getMessage());
        }
    }

    /**
     * Fetch timeline feed with keyset/cursor-based pagination.
     */
    public function feed(Request $request): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 15);
        $cursor = $request->query('cursor');
        $viewer = $request->user('sanctum');

        $paginator = $this->postService->getPublicFeed($viewer, $perPage, $cursor);

        return ApiResponse::success(
            data: $paginator->items(),
            message: 'Timeline feed retrieved successfully',
            extraMeta: [
                'next_cursor' => $paginator->nextCursor()?->encode(),
                'prev_cursor' => $paginator->previousCursor()?->encode(),
                'has_more' => $paginator->hasMorePages(),
                'per_page' => $paginator->perPage(),
            ]
        );
    }

    /**
     * Fetch posts created by a specific user with cursor pagination.
     */
    public function userPosts(Request $request, string $identifier): JsonResponse
    {
        $targetUser = User::where('id', $identifier)
            ->orWhere('handle', ltrim($identifier, '@'))
            ->first();

        if (!$targetUser) {
            return ApiResponse::notFound('User not found.');
        }

        $perPage = (int) $request->query('per_page', 15);
        $cursor = $request->query('cursor');
        $viewer = $request->user('sanctum');

        $paginator = $this->postService->getUserPosts($targetUser, $viewer, $perPage, $cursor);

        return ApiResponse::success(
            data: $paginator->items(),
            message: 'User posts retrieved successfully',
            extraMeta: [
                'next_cursor' => $paginator->nextCursor()?->encode(),
                'prev_cursor' => $paginator->previousCursor()?->encode(),
                'has_more' => $paginator->hasMorePages(),
                'per_page' => $paginator->perPage(),
            ]
        );
    }

    /**
     * Fetch hyperlocal feed for a ward.
     */
    public function hyperlocalFeed(Request $request, string $wardCode): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 15);
        $cursor = $request->query('cursor');
        $viewer = $request->user('sanctum');

        $paginator = $this->postService->getHyperlocalFeed($wardCode, $viewer, $perPage, $cursor);

        return ApiResponse::success(
            data: $paginator->items(),
            message: 'Hyperlocal feed retrieved successfully',
            extraMeta: [
                'next_cursor' => $paginator->nextCursor()?->encode(),
                'prev_cursor' => $paginator->previousCursor()?->encode(),
                'has_more' => $paginator->hasMorePages(),
                'per_page' => $paginator->perPage(),
            ]
        );
    }
}
