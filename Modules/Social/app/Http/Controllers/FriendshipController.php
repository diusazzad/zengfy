<?php

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Social\Models\Friendship;
use Modules\Social\Services\SocialGraphService;
use Symfony\Component\HttpFoundation\Response;

class FriendshipController extends Controller
{
    public function __construct(
        protected SocialGraphService $graphService
    ) {}

    /**
     * Send a friend request.
     */
    public function sendRequest(Request $request, string $id): JsonResponse
    {
        $sender = $request->user();
        $receiver = User::find($id);

        if (!$receiver) {
            return ApiResponse::error('Target user not found', Response::HTTP_NOT_FOUND, null, 'USER_NOT_FOUND');
        }

        try {
            $friendship = $this->graphService->sendFriendRequest($sender, $receiver);
        } catch (\InvalidArgumentException $e) {
            return ApiResponse::error($e->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY, null, 'INVALID_ACTION');
        }

        return ApiResponse::created($friendship, 'Friend request sent successfully');
    }

    /**
     * Accept a pending friend request.
     */
    public function acceptRequest(Request $request, string $id): JsonResponse
    {
        $receiver = $request->user();

        try {
            $friendship = $this->graphService->acceptFriendRequest($id, $receiver);
        } catch (\Exception $e) {
            return ApiResponse::error('Unable to accept friend request', Response::HTTP_BAD_REQUEST, null, 'INVALID_ACTION');
        }

        return ApiResponse::success($friendship, 'Friend request accepted');
    }

    /**
     * Decline a pending friend request.
     */
    public function declineRequest(Request $request, string $id): JsonResponse
    {
        $receiver = $request->user();

        try {
            $friendship = $this->graphService->declineFriendRequest($id, $receiver);
        } catch (\Exception $e) {
            return ApiResponse::error('Unable to decline friend request', Response::HTTP_BAD_REQUEST, null, 'INVALID_ACTION');
        }

        return ApiResponse::success($friendship, 'Friend request declined');
    }

    /**
     * Remove a mutual friend.
     */
    public function removeFriend(Request $request, string $id): JsonResponse
    {
        $userA = $request->user();
        $userB = User::find($id);

        if (!$userB) {
            return ApiResponse::error('User not found', Response::HTTP_NOT_FOUND, null, 'USER_NOT_FOUND');
        }

        $removed = $this->graphService->removeFriend($userA, $userB);

        if (!$removed) {
            return ApiResponse::error('Friendship record not found', Response::HTTP_NOT_FOUND, null, 'NOT_FRIENDS');
        }

        return ApiResponse::success(null, 'Friend removed successfully');
    }

    /**
     * List incoming pending friend requests for the authenticated citizen.
     */
    public function pendingRequests(Request $request): JsonResponse
    {
        $user = $request->user();

        $requests = Friendship::where('receiver_id', $user->id)
            ->where('status', 'pending')
            ->with('sender:id,name,handle,avatar,verified_badge')
            ->latest()
            ->paginate(20);

        return ApiResponse::success($requests, 'Pending friend requests retrieved');
    }

    /**
     * List accepted mutual friends for a citizen.
     */
    public function friends(string $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return ApiResponse::error('User not found', Response::HTTP_NOT_FOUND, null, 'USER_NOT_FOUND');
        }

        $friendships = Friendship::where('status', 'accepted')
            ->where(function ($q) use ($user) {
                $q->where('sender_id', $user->id)->orWhere('receiver_id', $user->id);
            })
            ->with(['sender:id,name,handle,avatar,verified_badge', 'receiver:id,name,handle,avatar,verified_badge'])
            ->latest()
            ->paginate(20);

        // Map mutual friends to show the other party's details
        $friendships->getCollection()->transform(function ($f) use ($user) {
            $otherUser = $f->sender_id === $user->id ? $f->receiver : $f->sender;
            return [
                'friendship_id' => $f->id,
                'user' => $otherUser,
                'friends_since' => $f->updated_at,
            ];
        });

        return ApiResponse::success($friendships, 'Mutual friends retrieved successfully');
    }
}
