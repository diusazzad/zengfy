<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Organization\Traits\HasTenantPermissions;
use Modules\Social\Traits\HasSocialGraph;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, HasSocialGraph, HasTenantPermissions, HasUuids, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'handle',
        'email',
        'password',
        'uuid',
        'google_id',
        'user_type',
        'phone',
        'avatar',
        'bio',
        'ward_code',
        'thana_code',
        'district_code',
        'followers_count',
        'following_count',
        'friends_count',
        'is_private',
        'nid_verified',
        'school_id_verified',
        'nid_card_path',
        'school_id_path',
        'provider',
        'provider_id',
        'registration_ip',
        'country_code',
        'city',
        'nid_number',
        'nid_hash',
        'date_of_birth',
        'nid_verified_at',
        'verified_badge',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'nid_hash',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'nid_number' => 'encrypted',
            'nid_verified' => 'boolean',
            'verified_badge' => 'boolean',
            'nid_verified_at' => 'datetime',
            'date_of_birth' => 'date',
        ];
    }

    /**
     * Return masked NID string for safe display (e.g. ******7890).
     */
    public function maskedNid(): ?string
    {
        if (empty($this->nid_number)) {
            return null;
        }

        $clean = (string) $this->nid_number;
        $len = strlen($clean);

        if ($len <= 4) {
            return $clean;
        }

        return str_repeat('*', $len - 4) . substr($clean, -4);
    }

    /**
     * Generate deterministic blind index hash for O(1) duplicate NID detection.
     */
    public static function generateNidHash(string $nidNumber): string
    {
        return hash_hmac('sha256', trim($nidNumber), config('app.key'));
    }

    public function posts()
    {
        return $this->hasMany(\Modules\Social\Models\Post::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(\Modules\Main\Models\Like::class);
    }

    public function comments()
    {
        return $this->hasMany(\Modules\Main\Models\Comment::class);
    }

    /**
     * Get the devices for the user.
     */
    public function devices()
    {
        return $this->hasMany(\Modules\Auth\Models\UserDevice::class);
    }

    /**
     * Check if user has a specific role based on user_type.
     */
    public function hasRole(string $role): bool
    {
        return $this->user_type === $role;
    }

    /**
     * Organization memberships associated with this user.
     */
    public function organizationMemberships(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\Modules\Organization\Models\OrganizationMembership::class, 'user_id');
    }

    /**
     * Organizations this user belongs to.
     */
    public function organizations(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            \Modules\Organization\Models\Organization::class,
            'organization_memberships',
            'user_id',
            'organization_id'
        )->withPivot(['role', 'status', 'joined_at'])->withTimestamps();
    }
}

