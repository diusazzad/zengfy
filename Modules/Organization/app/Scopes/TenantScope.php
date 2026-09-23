<?php

namespace Modules\Organization\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Modules\Organization\Services\TenantContext;

class TenantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (TenantContext::hasTenant()) {
            $builder->where($model->qualifyColumn('organization_id'), TenantContext::getTenantId());
        }
    }
}
