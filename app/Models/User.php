<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, HasUuids, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'uuid',
        'google_id',
        'user_type',
        'phone',
        'avatar',
        'nid_verified',
        'school_id_verified',
        'nid_card_path',
        'school_id_path',
        'provider',
        'provider_id',
        'registration_ip',
        'country_code',
        'city',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
        ];
    }

    public function posts()
    {
        return $this->hasMany(\Modules\Main\Models\Post::class);
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
}
