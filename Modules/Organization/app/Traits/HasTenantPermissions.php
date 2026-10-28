<?php

namespace Modules\Organization\Traits;

use Illuminate\Database\Eloquent\Collection;
use Modules\Organization\Models\Organization;
use Modules\Organization\Models\OrganizationMembership;
use Modules\Organization\Models\Role;
use Modules\Organization\Services\RbacEngine;
use Modules\Organization\Services\TenantContext;

trait HasTenantPermissions
{
    /**
     * Check if user has a specific permission in the given organization (or active tenant context).
     */
    public function hasTenantPermission(string $permissionSlug, ?Organization $organization = null): bool
    {
        $organization = $organization ?? TenantContext::getTenant();

        if (!$organization) {
            return false;
        }

        return RbacEngine::hasPermission($this, $organization, $permissionSlug);
    }

    /**
     * Assign a granular role to the user within an organization.
     */
    public function assignTenantRole(Role|string $role, ?Organization $organization = null): void
    {
        $organization = $organization ?? TenantContext::getTenant();

        if (!$organization) {
            throw new \InvalidArgumentException('Organization context required to assign tenant role');
        }

        $membership = OrganizationMembership::where('organization_id', $organization->id)
            ->where('user_id', $this->id)
            ->firstOrFail();

        if (is_string($role)) {
            $role = Role::where(function ($query) use ($organization) {
                $query->where('organization_id', $organization->id)
                    ->orWhereNull('organization_id');
            })->where('slug', $role)->firstOrFail();
        }

        $membership->roles()->syncWithoutDetaching([$role->id]);

        RbacEngine::invalidateUserPermissions($this, $organization);
    }

    /**
     * Remove a granular role from the user within an organization.
     */
    public function removeTenantRole(Role|string $role, ?Organization $organization = null): void
    {
        $organization = $organization ?? TenantContext::getTenant();

        if (!$organization) {
            throw new \InvalidArgumentException('Organization context required to remove tenant role');
        }

        $membership = OrganizationMembership::where('organization_id', $organization->id)
            ->where('user_id', $this->id)
            ->firstOrFail();

        if (is_string($role)) {
            $role = Role::where(function ($query) use ($organization) {
                $query->where('organization_id', $organization->id)
                    ->orWhereNull('organization_id');
            })->where('slug', $role)->first();
        }

        if ($role) {
            $membership->roles()->detach($role->id);
            RbacEngine::invalidateUserPermissions($this, $organization);
        }
    }

    /**
     * Get all assigned roles for this user in the specified organization.
     */
    public function getTenantRoles(?Organization $organization = null): Collection
    {
        $organization = $organization ?? TenantContext::getTenant();

        if (!$organization) {
            return new Collection();
        }

        $membership = OrganizationMembership::where('organization_id', $organization->id)
            ->where('user_id', $this->id)
            ->first();

        return $membership ? $membership->roles : new Collection();
    }
}
