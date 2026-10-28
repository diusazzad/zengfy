<?php

namespace Modules\Organization\Services;

use Modules\Organization\Models\Organization;

class TenantContext
{
    /**
     * The actively bound organization for the current request cycle.
     */
    protected static ?Organization $tenant = null;

    /**
     * Flag indicating whether tenant scoping should be temporarily bypassed.
     */
    protected static bool $bypassed = false;

    /**
     * Set the current tenant.
     */
    public static function setTenant(?Organization $tenant): void
    {
        static::$tenant = $tenant;
    }

    /**
     * Get the current tenant.
     */
    public static function getTenant(): ?Organization
    {
        return static::$tenant;
    }

    /**
     * Get the current tenant UUID.
     */
    public static function getTenantId(): ?string
    {
        return static::$tenant?->id;
    }

    /**
     * Determine if a tenant is currently resolved.
     */
    public static function hasTenant(): bool
    {
        return static::$tenant !== null && !static::$bypassed;
    }

    /**
     * Clear the tenant context.
     */
    public static function clear(): void
    {
        static::$tenant = null;
        static::$bypassed = false;
    }

    /**
     * Run a given callback with tenant scoping disabled (administrative escape hatch).
     */
    public static function runWithoutTenantScope(callable $callback): mixed
    {
        $previous = static::$bypassed;
        static::$bypassed = true;

        try {
            return $callback();
        } finally {
            static::$bypassed = $previous;
        }
    }
}
