<?php

namespace Modules\Social\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmergencyEvent extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'accuracy',
        'ward_code',
        'thana_code',
        'district_code',
        'status',
        'distress_type',
        'battery_level',
        'notes',
        'resolved_at',
        'resolution_notes',
        'responders_count',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'accuracy' => 'float',
        'battery_level' => 'integer',
        'responders_count' => 'integer',
        'resolved_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByWard($query, string $wardCode)
    {
        return $query->where('ward_code', $wardCode);
    }
}
