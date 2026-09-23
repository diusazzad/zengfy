<?php

namespace Modules\Organization\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Organization\Http\Requests\CreateOrganizationRequest;
use Modules\Organization\Http\Requests\InviteMemberRequest;
use Modules\Organization\Models\Organization;
use Modules\Organization\Models\OrganizationMembership;
use Symfony\Component\HttpFoundation\Response;

class OrganizationController extends Controller
{
    /**
     * List all organizations the authenticated user belongs to.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $memberships = OrganizationMembership::with('organization')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->get();

        $organizations = $memberships->map(function ($membership) {
            return [
                'id' => $membership->organization->id,
                'name' => $membership->organization->name,
                'slug' => $membership->organization->slug,
                'domain_type' => $membership->organization->domain_type,
                'is_active' => $membership->organization->is_active,
                'membership' => [
                    'role' => $membership->role,
                    'status' => $membership->status,
                    'joined_at' => $membership->joined_at,
                ],
            ];
        });

        return ApiResponse::success($organizations, 'User organizations retrieved successfully');
    }

    /**
     * Create a new organization and assign the creator as owner.
     */
    public function store(CreateOrganizationRequest $request): JsonResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        $organization = DB::transaction(function () use ($user, $validated) {
            $org = Organization::create([
                'name' => $validated['name'],
                'slug' => $validated['slug'],
                'domain_type' => $validated['domain_type'] ?? 'school',
                'settings' => $validated['settings'] ?? null,
                'created_by_user_id' => $user->id,
            ]);

            OrganizationMembership::create([
                'organization_id' => $org->id,
                'user_id' => $user->id,
                'role' => 'owner',
                'status' => 'active',
                'joined_at' => now(),
            ]);

            return $org;
        });

        return ApiResponse::created($organization, 'Organization provisioned successfully');
    }

    /**
     * View organization details.
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $user = $request->user();

        $organization = Organization::where('id', $id)
            ->orWhere('slug', $id)
            ->first();

        if (!$organization) {
            return ApiResponse::error('Organization not found', Response::HTTP_NOT_FOUND, null, 'ORGANIZATION_NOT_FOUND');
        }

        $membership = OrganizationMembership::where('organization_id', $organization->id)
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (!$membership) {
            return ApiResponse::error(
                'Forbidden: You are not an active member of this organization',
                Response::HTTP_FORBIDDEN,
                null,
                'TENANT_ACCESS_DENIED'
            );
        }

        return ApiResponse::success([
            'organization' => $organization,
            'current_membership' => [
                'role' => $membership->role,
                'status' => $membership->status,
                'joined_at' => $membership->joined_at,
            ],
        ], 'Organization details retrieved successfully');
    }

    /**
     * Invite/add a member to the organization.
     */
    public function inviteMember(InviteMemberRequest $request, string $id): JsonResponse
    {
        $user = $request->user();
        $validated = $request->validated();

        $organization = Organization::where('id', $id)
            ->orWhere('slug', $id)
            ->first();

        if (!$organization) {
            return ApiResponse::error('Organization not found', Response::HTTP_NOT_FOUND, null, 'ORGANIZATION_NOT_FOUND');
        }

        // Authorization: caller must be owner or admin
        $callerMembership = OrganizationMembership::where('organization_id', $organization->id)
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (!$callerMembership || !in_array($callerMembership->role, ['owner', 'admin'])) {
            return ApiResponse::error(
                'Forbidden: Only organization owners or admins can invite members',
                Response::HTTP_FORBIDDEN,
                null,
                'INSUFFICIENT_PERMISSIONS'
            );
        }

        // Check if target user is already a member
        $existing = OrganizationMembership::where('organization_id', $organization->id)
            ->where('user_id', $validated['user_id'])
            ->first();

        if ($existing) {
            return ApiResponse::error(
                'User is already a member of this organization',
                Response::HTTP_CONFLICT,
                null,
                'DUPLICATE_MEMBERSHIP'
            );
        }

        $membership = OrganizationMembership::create([
            'organization_id' => $organization->id,
            'user_id' => $validated['user_id'],
            'role' => $validated['role'] ?? 'member',
            'status' => 'active',
            'joined_at' => now(),
        ]);

        return ApiResponse::created($membership, 'Member added to organization successfully');
    }

    /**
     * List all members of the organization.
     */
    public function listMembers(Request $request, string $id): JsonResponse
    {
        $user = $request->user();

        $organization = Organization::where('id', $id)
            ->orWhere('slug', $id)
            ->first();

        if (!$organization) {
            return ApiResponse::error('Organization not found', Response::HTTP_NOT_FOUND, null, 'ORGANIZATION_NOT_FOUND');
        }

        $callerMembership = OrganizationMembership::where('organization_id', $organization->id)
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (!$callerMembership) {
            return ApiResponse::error(
                'Forbidden: You are not an active member of this organization',
                Response::HTTP_FORBIDDEN,
                null,
                'TENANT_ACCESS_DENIED'
            );
        }

        $members = OrganizationMembership::with('user:id,name,email,avatar')
            ->where('organization_id', $organization->id)
            ->get()
            ->map(function ($m) {
                return [
                    'membership_id' => $m->id,
                    'user_id' => $m->user_id,
                    'name' => $m->user?->name,
                    'email' => $m->user?->email,
                    'avatar' => $m->user?->avatar,
                    'role' => $m->role,
                    'status' => $m->status,
                    'joined_at' => $m->joined_at,
                ];
            });

        return ApiResponse::success($members, 'Organization members retrieved successfully');
    }
}
