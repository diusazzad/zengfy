<?php

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;
use Modules\Social\Models\Like;
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
    public function store(Request $request)
    {
        $user = $request->user() ?: Auth::user();
        if (!$user) {
            return ApiResponse::unauthorized('You must be logged in to create a post.');
        }

        $validated = $request->validate([
            'content' => ['nullable', 'string', 'max:10000'],
            'post_type' => ['sometimes', 'string', 'in:standard,announcement,poll,hyperlocal_notice'],
            'visibility' => ['sometimes', 'string', 'in:public,friends_only,private'],
            'ward_code' => ['nullable', 'string', 'max:20'],
            'thana_code' => ['nullable', 'string', 'max:50'],
            'district_code' => ['nullable', 'string', 'max:50'],
            'is_pinned' => ['sometimes', 'boolean'],
            'image' => ['nullable', 'file', 'mimes:jpeg,png,jpg,webp,gif', 'max:15360'],
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

        // Process uploaded files if any
        $uploadedMedia = [];
        $candidateFiles = [];

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            if (is_array($img)) {
                $candidateFiles = array_merge($candidateFiles, $img);
            } else {
                $candidateFiles[] = $img;
            }
        }
        if ($request->hasFile('photos')) {
            $pts = $request->file('photos');
            if (is_array($pts)) {
                $candidateFiles = array_merge($candidateFiles, $pts);
            } else {
                $candidateFiles[] = $pts;
            }
        }
        if ($request->hasFile('photo')) {
            $candidateFiles[] = $request->file('photo');
        }
        if ($request->hasFile('file')) {
            $candidateFiles[] = $request->file('file');
        }

        foreach ($candidateFiles as $idx => $uploadedFile) {
            if ($uploadedFile && $uploadedFile->isValid()) {
                $path = $uploadedFile->store('posts', 'public');
                $url = asset('storage/' . $path);
                $uploadedMedia[] = [
                    'url' => $url,
                    'storage_path' => $path,
                    'media_type' => 'image',
                    'mime_type' => $uploadedFile->getClientMimeType() ?: 'image/jpeg',
                    'file_size_bytes' => $uploadedFile->getSize() ?: 0,
                    'order_column' => $idx,
                ];
            }
        }

        if (!empty($uploadedMedia)) {
            $validated['media'] = array_merge($validated['media'] ?? [], $uploadedMedia);
        }

        try {
            $post = $this->postService->createPost($user, $validated);

            if (!$request->wantsJson() && !$request->ajax() && !$request->expectsJson()) {
                return redirect()->back()->with('success', 'Post published successfully!');
            }

            return ApiResponse::created($post, 'Post created successfully');
        } catch (InvalidArgumentException $e) {
            if (!$request->wantsJson() && !$request->ajax() && !$request->expectsJson()) {
                return redirect()->back()->withErrors(['content' => $e->getMessage()]);
            }

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
        $user = $request->user() ?: Auth::user();
        if (!$user) {
            return ApiResponse::unauthorized('You must be logged in to delete a post.');
        }

        $post = Post::find($id);

        if (!$post) {
            return ApiResponse::notFound('Post not found.');
        }

        try {
            $this->postService->deletePost($user, $post);

            return ApiResponse::success(null, 'Post deleted successfully');
        } catch (AuthorizationException $e) {
            return ApiResponse::forbidden($e->getMessage());
        }
    }

    /**
     * Toggle like reaction on a post.
     */
    public function toggleLike(Request $request, string $id): JsonResponse
    {
        $user = $request->user() ?: Auth::user();
        if (!$user) {
            return ApiResponse::unauthorized('You must be logged in to like this post.');
        }

        $post = Post::find($id);
        if (!$post) {
            return ApiResponse::notFound('Post not found.');
        }

        $existing = Like::where('user_id', $user->id)->where('post_id', $post->id)->first();
        if ($existing) {
            $existing->delete();
            $post->decrement('likes_count');
            $liked = false;
        } else {
            Like::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);
            $post->increment('likes_count');
            $liked = true;
        }

        return ApiResponse::success([
            'liked' => $liked,
            'likes_count' => (int) $post->fresh()->likes_count,
        ], $liked ? 'Post liked' : 'Post unliked');
    }

    /**
     * Fetch timeline feed with keyset/cursor-based pagination.
     * Supports 4 dynamic streams: 'world', 'friends', 'community', and 'nearby'.
     */
    public function feed(Request $request): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 15);
        $cursor = $request->query('cursor');
        $filter = $request->query('filter', 'world');
        $wardCode = $request->query('ward_code');
        $viewer = $request->user('sanctum') ?: \Illuminate\Support\Facades\Auth::user();

        $paginator = $this->postService->getPublicFeed($viewer, $perPage, $cursor, $filter, $wardCode);

        return ApiResponse::success(
            data: $paginator->items(),
            message: 'Timeline feed retrieved successfully',
            extraMeta: [
                'next_cursor' => $paginator->nextCursor()?->encode(),
                'prev_cursor' => $paginator->previousCursor()?->encode(),
                'has_more' => $paginator->hasMorePages(),
                'per_page' => $paginator->perPage(),
                'filter' => $filter,
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
