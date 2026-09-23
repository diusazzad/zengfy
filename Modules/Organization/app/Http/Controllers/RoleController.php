<?php

namespace Modules\Organization\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Organization\Http\Requests\AssignRoleRequest;
use Modules\Organization\Http\Requests\CreateRoleRequest;
use Modules\Organization\Models\Organization;
use Modules\Organization\Models\OrganizationMembership;
use Modules\Organization\Models\Permission;
use Modules\Organization\Models\Role;
use Modules\Organization\Services\RbacEngine;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    /**
     * List all available system permissions grouped by module.
     */
    public function listPermissions(): JsonResponse
    {
        $permissions = Permission::all()->groupBy('module');

        return ApiResponse::success($permissions, 'Permissions retrieved successfully');
    }

    /**
     * List all roles accessible to this tenant (system templates + custom tenant roles).
     */
    public function index(Request $request, string $organization): JsonResponse
    {
        $org = Organization::where('id', $organization)->orWhere('slug', $organization)->firstOrFail();

        $roles = Role::where(function ($query) use ($org) {
            $query->where('organization_id', $org->id)
                ->orWhereNull('organization_id');
        })->with('permissions:id,name,slug,module')->get();

        return ApiResponse::success($roles, 'Tenant roles retrieved successfully');
    }

    /**
     * Create a custom tenant role and attach permissions.
     */
    public function store(CreateRoleRequest $request, string $organization): JsonResponse
    {
        $user = $request->user();
        $org = Organization::where('id', $organization)->orWhere('slug', $organization)->firstOrFail();

        // Enforce authorization: only owners or users with 'roles.manage' can create roles
        if (!$user->hasTenantPermission('roles.manage', $org)) {
            return ApiResponse::error(
                'Forbidden: You lack the required permission [roles.manage]',
                Response::HTTP_FORBIDDEN,
                null,
                'INSUFFICIENT_PERMISSIONS'
            );
        }

        $validated = $request->validated();

        $role = Role::create([
            'organization_id' => $org->id,
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'description' => $validated['description'] ?? null,
        ]);

        if (!empty($validated['permissions'])) {
            $permissionIds = Permission::whereIn('slug', $validated['permissions'])->pluck('id');
            $role->permissions()->sync($permissionIds);
        }

        $role->load('permissions:id,name,slug,module');

        return ApiResponse::created($role, 'Custom tenant role created successfully');
    }

    /**
     * Assign a granular role to an organization member.
     */
    public function assignRoleToMember(AssignRoleRequest $request, string $organization, string $membershipId): JsonResponse
    {
        $user = $request->user();
        $org = Organization::where('id', $organization)->orWhere('slug', $organization)->firstOrFail();

        if (!$user->hasTenantPermission('roles.manage', $org)) {
            return ApiResponse::error(
                'Forbidden: You lack the required permission [roles.manage]',
                Response::HTTP_FORBIDDEN,
                null,
                'INSUFFICIENT_PERMISSIONS'
            );
        }

        $membership = OrganizationMembership::where('organization_id', $org->id)
            ->where('id', $membershipId)
            ->firstOrFail();

        $role = Role::where(function ($query) use ($org) {
            $query->where('organization_id', $org->id)
                ->orWhereNull('organization_id');
        })->where('id', $request->role_id)->firstOrFail();

        $membership->roles()->syncWithoutDetaching([$role->id]);

        // Invalidate cached permissions for the target user
        RbacEngine::invalidateUserPermissions($membership->user, $org);

        return ApiResponse::success([
            'membership_id' => $membership->id,
            'user_id' => $membership->user_id,
            'assigned_role' => [
                'id' => $role->id,
                'name' => $role->name,
                'slug' => $role->slug,
            ],
        ], 'Role assigned to member successfully');
    }

    /**
     * Remove a role from an organization member.
     */
    public function removeRoleFromMember(Request $request, string $organization, string $membershipId, string $roleId): JsonResponse
    {
        $user = $request->user();
        $org = Organization::where('id', $organization)->orWhere('slug', $organization)->firstOrFail();

        if (!$user->hasTenantPermission('roles.manage', $org)) {
            return ApiResponse::error(
                'Forbidden: You lack the required permission [roles.manage]',
                Response::HTTP_FORBIDDEN,
                null,
                'INSUFFICIENT_PERMISSIONS'
            );
        }

        $membership = OrganizationMembership::where('organization_id', $org->id)
            ->where('id', $membershipId)
            ->firstOrFail();

        $membership->roles()->detach($roleId);

        // Invalidate cached permissions
        RbacEngine::invalidateUserPermissions($membership->user, $org);

        return ApiResponse::success(null, 'Role revoked from member successfully');
    }
}
