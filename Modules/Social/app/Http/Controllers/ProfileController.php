<?php

namespace Modules\Social\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Social\Services\SocialGraphService;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    public function __construct(
        protected SocialGraphService $graphService
    ) {}

    /**
     * View a citizen's public profile.
     */
    public function show(Request $request, string $identifier): JsonResponse
    {
        $targetUser = User::where('id', $identifier)
            ->orWhere('handle', ltrim($identifier, '@'))
            ->first();

        if (!$targetUser) {
            return ApiResponse::error('User profile not found', Response::HTTP_NOT_FOUND, null, 'USER_NOT_FOUND');
        }

        $viewer = $request->user();
        $counts = $this->graphService->getCounts($targetUser);

        $relationship = [
            'is_following' => $viewer ? $this->graphService->isFollowing($viewer, $targetUser) : false,
            'is_followed_by' => $viewer ? $this->graphService->isFollowing($targetUser, $viewer) : false,
            'friendship_status' => $viewer ? $this->graphService->getFriendshipStatus($viewer, $targetUser) : null,
        ];

        return ApiResponse::success([
            'id' => $targetUser->id,
            'name' => $targetUser->name,
            'handle' => $targetUser->handle,
            'avatar' => $targetUser->avatar,
            'bio' => $targetUser->bio,
            'ward_code' => $targetUser->ward_code,
            'thana_code' => $targetUser->thana_code,
            'district_code' => $targetUser->district_code,
            'verified_badge' => (bool) $targetUser->verified_badge,
            'counts' => $counts,
            'relationship' => $relationship,
        ], 'Profile retrieved successfully');
    }

    /**
     * Update authenticated citizen's profile.
     */
    public function update(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($request->has('handle')) {
            $request->merge([
                'handle' => ltrim((string) $request->input('handle'), '@'),
            ]);
        }

        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'handle' => ['sometimes', 'string', 'max:50', 'alpha_dash', 'unique:users,handle,' . $user->id],
            'bio' => ['nullable', 'string', 'max:500'],
            'avatar' => ['nullable', 'string', 'max:2048'],
            'ward_code' => ['nullable', 'string', 'max:20'],
            'thana_code' => ['nullable', 'string', 'max:50'],
            'district_code' => ['nullable', 'string', 'max:50'],
            'is_private' => ['sometimes', 'boolean'],
        ]);

        $user->update($validated);

        return ApiResponse::success($user->only([
            'id', 'name', 'handle', 'avatar', 'bio', 'ward_code', 'thana_code', 'district_code', 'is_private'
        ]), 'Profile updated successfully');
    }
}
