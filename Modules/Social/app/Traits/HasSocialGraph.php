<?php

namespace Modules\Social\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Social\Models\Follow;
use Modules\Social\Models\Friendship;
use Modules\Social\Services\SocialGraphService;

trait HasSocialGraph
{
    /**
     * Citizens following this user.
     */
    public function followers(): HasMany
    {
        return $this->hasMany(Follow::class, 'following_id');
    }

    /**
     * Citizens this user is following.
     */
    public function following(): HasMany
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    /**
     * Friend requests sent by this user.
     */
    public function friendRequestsSent(): HasMany
    {
        return $this->hasMany(Friendship::class, 'sender_id');
    }

    /**
     * Friend requests received by this user.
     */
    public function friendRequestsReceived(): HasMany
    {
        return $this->hasMany(Friendship::class, 'receiver_id');
    }

    /**
     * Check if this user is following another user.
     */
    public function isFollowing(User $user): bool
    {
        return app(SocialGraphService::class)->isFollowing($this, $user);
    }

    /**
     * Get graph counts ($O(1) cached).
     */
    public function getGraphCounts(): array
    {
        return app(SocialGraphService::class)->getCounts($this);
    }
}
