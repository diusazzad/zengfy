<?php

namespace Modules\Organization\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'organizations';

    protected $fillable = [
        'name',
        'slug',
        'domain_type',
        'is_active',
        'settings',
        'created_by_user_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'settings' => 'array',
    ];

    /**
     * The user who originally provisioned the organization.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    /**
     * Memberships associated with the organization.
     */
    public function memberships(): HasMany
    {
        return $this->hasMany(OrganizationMembership::class, 'organization_id');
    }

    /**
     * Users belonging to this organization.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'organization_memberships', 'organization_id', 'user_id')
            ->withPivot(['role', 'status', 'joined_at'])
            ->withTimestamps();
    }

    /**
     * Departments belonging to this organization.
     */
    public function departments(): HasMany
    {
        return $this->hasMany(OrganizationDepartment::class, 'organization_id');
    }

    /**
     * Check if a given user is an active member.
     */
    public function hasActiveMember(User $user): bool
    {
        return $this->memberships()
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->exists();
    }

    /**
     * Get a member's role in this organization.
     */
    public function getMemberRole(User $user): ?string
    {
        return $this->memberships()
            ->where('user_id', $user->id)
            ->value('role');
    }
}
