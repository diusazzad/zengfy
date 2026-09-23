<?php

namespace Modules\Organization\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Organization\Models\Organization;
use Modules\Organization\Scopes\TenantScope;
use Modules\Organization\Services\TenantContext;

trait BelongsToTenant
{
    /**
     * Boot the trait and apply the global tenant scope & auto-stamping listener.
     */
    public static function bootBelongsToTenant(): void
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {
            if (empty($model->organization_id) && TenantContext::hasTenant()) {
                $model->organization_id = TenantContext::getTenantId();
            }
        });
    }

    /**
     * Relationship to the tenant organization.
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
