<?php

namespace Modules\Organization\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Organization\Traits\BelongsToTenant;

class OrganizationDepartment extends Model
{
    use HasFactory, HasUuids, BelongsToTenant;

    protected $table = 'organization_departments';

    protected $fillable = [
        'organization_id',
        'name',
        'code',
    ];
}
