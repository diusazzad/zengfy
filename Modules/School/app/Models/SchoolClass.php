<?php

namespace Modules\School\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Organization\Traits\BelongsToTenant;

class SchoolClass extends Model
{
    use HasFactory, HasUuids, BelongsToTenant;

    protected $table = 'school_classes';

    protected $fillable = [
        'organization_id',
        'academic_year_id',
        'name',
        'numeric_grade',
        'code',
        'description',
    ];

    protected $casts = [
        'numeric_grade' => 'integer',
    ];

    /**
     * Academic year this class belongs to.
     */
    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    /**
     * Sections under this class.
     */
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'class_id');
    }

    /**
     * Subjects taught in this class.
     */
    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class, 'class_id');
    }
}
