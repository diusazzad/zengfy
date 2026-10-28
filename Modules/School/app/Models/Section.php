<?php

namespace Modules\School\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Organization\Traits\BelongsToTenant;

class Section extends Model
{
    use HasFactory, HasUuids, BelongsToTenant;

    protected $table = 'sections';

    protected $fillable = [
        'organization_id',
        'class_id',
        'name',
        'capacity',
        'room_number',
    ];

    protected $casts = [
        'capacity' => 'integer',
    ];

    /**
     * Parent school class.
     */
    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
