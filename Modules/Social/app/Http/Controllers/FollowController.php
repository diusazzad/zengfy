<?php

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Social\Models\Follow;
use Modules\Social\Services\SocialGraphService;
use Symfony\Component\HttpFoundation\Response;

class FollowController extends Controller
{
    public function __construct(
        protected SocialGraphService $graphService
    ) {}

    /**
     * Follow a citizen.
     */
    public function follow(Request $request, string $id): JsonResponse
    {
        $follower = $request->user();
        $target = User::find($id);

        if (!$target) {
            return ApiResponse::error('Target user not found', Response::HTTP_NOT_FOUND, null, 'USER_NOT_FOUND');
        }

        try {
            $this->graphService->follow($follower, $target);
        } catch (\InvalidArgumentException $e) {
            return ApiResponse::error($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY, null, 'INVALID_ACTION');
        }

        return ApiResponse::success([
            'following' => true,
            'target_id' => $target->id,
        ], 'You are now following ' . ($target->handle ? '@' . $target->handle : $target->name));
    }

    /**
     * Unfollow a citizen.
     */
    public function unfollow(Request $request, string $id): JsonResponse
    {
        $follower = $request->user();
        $target = User::find($id);

        if (!$target) {
            return ApiResponse::error('Target user not found', Response::HTTP_NOT_FOUND, null, 'USER_NOT_FOUND');
        }

        $this->graphService->unfollow($follower, $target);

        return ApiResponse::success([
            'following' => false,
            'target_id' => $target->id,
        ], 'You unfollowed ' . ($target->handle ? '@' . $target->handle : $target->name));
    }

    /**
     * List a citizen's followers.
     */
    public function followers(string $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return ApiResponse::error('User not found', Response::HTTP_NOT_FOUND, null, 'USER_NOT_FOUND');
        }

        $followers = Follow::where('following_id', $user->id)
            ->with('follower:id,name,handle,avatar,verified_badge')
            ->latest()
            ->paginate(20);

        return ApiResponse::success($followers, 'Followers retrieved successfully');
    }

    /**
     * List citizens this user is following.
     */
    public function following(string $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return ApiResponse::error('User not found', Response::HTTP_NOT_FOUND, null, 'USER_NOT_FOUND');
        }

        $following = Follow::where('follower_id', $user->id)
            ->with('following:id,name,handle,avatar,verified_badge')
            ->latest()
            ->paginate(20);

        return ApiResponse::success($following, 'Following list retrieved successfully');
    }
}
