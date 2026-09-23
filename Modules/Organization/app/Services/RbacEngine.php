<?php

namespace Modules\Organization\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Modules\Organization\Models\Organization;
use Modules\Organization\Models\OrganizationMembership;

class RbacEngine
{
    /**
     * Cache TTL in seconds (10 minutes).
     */
    protected const CACHE_TTL = 600;

    /**
     * In-memory cache for the current request cycle.
     */
    protected static array $runtimeCache = [];

    /**
     * Get all permission slugs for a user within an organization.
     *
     * @return array<string>
     */
    public static function getUserPermissions(User $user, Organization $organization): array
    {
        $cacheKey = "tenant:{$organization->id}:user:{$user->id}:permissions";

        if (isset(static::$runtimeCache[$cacheKey])) {
            return static::$runtimeCache[$cacheKey];
        }

        $permissions = Cache::remember($cacheKey, static::CACHE_TTL, function () use ($user, $organization) {
            $membership = OrganizationMembership::where('organization_id', $organization->id)
                ->where('user_id', $user->id)
                ->where('status', 'active')
                ->with(['roles.permissions'])
                ->first();

            if (!$membership) {
                return [];
            }

            // Owner superadmin wildcard: owners have full access to everything in their organization
            if ($membership->role === 'owner') {
                return ['*'];
            }

            $permissionSlugs = [];

            foreach ($membership->roles as $role) {
                foreach ($role->permissions as $permission) {
                    $permissionSlugs[] = $permission->slug;
                }
            }

            return array_values(array_unique($permissionSlugs));
        });

        static::$runtimeCache[$cacheKey] = $permissions;

        return $permissions;
    }

    /**
     * Check if a user possesses a specific permission within an organization.
     */
    public static function hasPermission(User $user, Organization $organization, string $permissionSlug): bool
    {
        $permissions = static::getUserPermissions($user, $organization);

        // Wildcard check
        if (in_array('*', $permissions, true)) {
            return true;
        }

        return in_array($permissionSlug, $permissions, true);
    }

    /**
     * Invalidate cached permissions for a user within an organization.
     */
    public static function invalidateUserPermissions(User $user, Organization $organization): void
    {
        $cacheKey = "tenant:{$organization->id}:user:{$user->id}:permissions";
        unset(static::$runtimeCache[$cacheKey]);
        Cache::forget($cacheKey);
    }

    /**
     * Clear all runtime cache (useful for tests).
     */
    public static function clearRuntimeCache(): void
    {
        static::$runtimeCache = [];
    }
}
