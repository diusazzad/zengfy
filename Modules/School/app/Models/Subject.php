<?php

namespace Modules\School\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Organization\Traits\BelongsToTenant;

class Subject extends Model
{
    use HasFactory, HasUuids, BelongsToTenant;

    protected $table = 'subjects';

    protected $fillable = [
        'organization_id',
        'class_id',
        'name',
        'code',
        'type',
        'credits',
        'pass_marks',
        'total_marks',
    ];

    protected $casts = [
        'credits' => 'float',
        'pass_marks' => 'integer',
        'total_marks' => 'integer',
    ];

    /**
     * Parent school class.
     */
    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
