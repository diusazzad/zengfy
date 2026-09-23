<?php

namespace Modules\Social\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Social\Models\Follow;
use Modules\Social\Models\Friendship;

class SocialGraphService
{
    /**
     * Cache TTL in seconds (1 hour).
     */
    protected const CACHE_TTL = 3600;

    /**
     * Follow a target citizen.
     */
    public function follow(User $follower, User $target): bool
    {
        if ($follower->id === $target->id) {
            throw new \InvalidArgumentException('You cannot follow yourself');
        }

        $existing = Follow::where('follower_id', $follower->id)
            ->where('following_id', $target->id)
            ->first();

        if ($existing) {
            return true;
        }

        DB::transaction(function () use ($follower, $target) {
            Follow::create([
                'follower_id' => $follower->id,
                'following_id' => $target->id,
            ]);

            $target->increment('followers_count');
            $follower->increment('following_count');
        });

        $this->syncCounts($target);
        $this->syncCounts($follower);

        return true;
    }

    /**
     * Unfollow a target citizen.
     */
    public function unfollow(User $follower, User $target): bool
    {
        $follow = Follow::where('follower_id', $follower->id)
            ->where('following_id', $target->id)
            ->first();

        if (!$follow) {
            return false;
        }

        DB::transaction(function () use ($follow, $follower, $target) {
            $follow->delete();

            if ($target->followers_count > 0) {
                $target->decrement('followers_count');
            }
            if ($follower->following_count > 0) {
                $follower->decrement('following_count');
            }
        });

        $this->syncCounts($target);
        $this->syncCounts($follower);

        return true;
    }

    /**
     * Send a friend request.
     */
    public function sendFriendRequest(User $sender, User $receiver): Friendship
    {
        if ($sender->id === $receiver->id) {
            throw new \InvalidArgumentException('You cannot send a friend request to yourself');
        }

        $existing = Friendship::where(function ($q) use ($sender, $receiver) {
            $q->where('sender_id', $sender->id)->where('receiver_id', $receiver->id);
        })->orWhere(function ($q) use ($sender, $receiver) {
            $q->where('sender_id', $receiver->id)->where('receiver_id', $sender->id);
        })->first();

        if ($existing) {
            if ($existing->status === 'accepted') {
                throw new \InvalidArgumentException('You are already friends with this citizen');
            }
            if ($existing->status === 'pending') {
                // If the other user already sent a pending request, auto-accept it!
                if ($existing->sender_id === $receiver->id) {
                    return $this->acceptFriendRequest($existing->id, $sender);
                }
                throw new \InvalidArgumentException('Friend request is already pending');
            }

            // If previously declined, update status back to pending
            $existing->update([
                'sender_id' => $sender->id,
                'receiver_id' => $receiver->id,
                'status' => 'pending',
            ]);
            return $existing;
        }

        return Friendship::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'status' => 'pending',
        ]);
    }

    /**
     * Accept a pending friend request.
     */
    public function acceptFriendRequest(string $friendshipId, User $receiver): Friendship
    {
        $friendship = Friendship::where('id', $friendshipId)
            ->where('receiver_id', $receiver->id)
            ->where('status', 'pending')
            ->firstOrFail();

        DB::transaction(function () use ($friendship, $receiver) {
            $friendship->update(['status' => 'accepted']);

            $sender = $friendship->sender;
            $sender->increment('friends_count');
            $receiver->increment('friends_count');
        });

        $this->syncCounts($friendship->sender);
        $this->syncCounts($receiver);

        return $friendship;
    }

    /**
     * Decline a pending friend request.
     */
    public function declineFriendRequest(string $friendshipId, User $receiver): Friendship
    {
        $friendship = Friendship::where('id', $friendshipId)
            ->where('receiver_id', $receiver->id)
            ->where('status', 'pending')
            ->firstOrFail();

        $friendship->update(['status' => 'declined']);

        return $friendship;
    }

    /**
     * Remove mutual friendship.
     */
    public function removeFriend(User $userA, User $userB): bool
    {
        $friendship = Friendship::where('status', 'accepted')
            ->where(function ($q) use ($userA, $userB) {
                $q->where(function ($sq) use ($userA, $userB) {
                    $sq->where('sender_id', $userA->id)->where('receiver_id', $userB->id);
                })->orWhere(function ($sq) use ($userA, $userB) {
                    $sq->where('sender_id', $userB->id)->where('receiver_id', $userA->id);
                });
            })->first();

        if (!$friendship) {
            return false;
        }

        DB::transaction(function () use ($friendship, $userA, $userB) {
            $friendship->delete();

            if ($userA->friends_count > 0) {
                $userA->decrement('friends_count');
            }
            if ($userB->friends_count > 0) {
                $userB->decrement('friends_count');
            }
        });

        $this->syncCounts($userA);
        $this->syncCounts($userB);

        return true;
    }

    /**
     * Get $O(1)$ fast graph counters from Redis/Cache.
     */
    public function getCounts(User $user): array
    {
        return [
            'followers_count' => (int) Cache::remember(
                "user:{$user->id}:followers_count",
                static::CACHE_TTL,
                fn() => Follow::where('following_id', $user->id)->count()
            ),
            'following_count' => (int) Cache::remember(
                "user:{$user->id}:following_count",
                static::CACHE_TTL,
                fn() => Follow::where('follower_id', $user->id)->count()
            ),
            'friends_count' => (int) Cache::remember(
                "user:{$user->id}:friends_count",
                static::CACHE_TTL,
                fn() => Friendship::where('status', 'accepted')
                    ->where(function ($q) use ($user) {
                        $q->where('sender_id', $user->id)->orWhere('receiver_id', $user->id);
                    })->count()
            ),
        ];
    }

    /**
     * Synchronize and refresh cache counters for a user.
     */
    public function syncCounts(User $user): void
    {
        Cache::forget("user:{$user->id}:followers_count");
        Cache::forget("user:{$user->id}:following_count");
        Cache::forget("user:{$user->id}:friends_count");
        $this->getCounts($user);
    }

    /**
     * Check if user A is following user B.
     */
    public function isFollowing(User $userA, User $userB): bool
    {
        return Follow::where('follower_id', $userA->id)
            ->where('following_id', $userB->id)
            ->exists();
    }

    /**
     * Get friendship status between two users.
     */
    public function getFriendshipStatus(User $viewer, User $target): ?string
    {
        $friendship = Friendship::where(function ($q) use ($viewer, $target) {
            $q->where('sender_id', $viewer->id)->where('receiver_id', $target->id);
        })->orWhere(function ($q) use ($viewer, $target) {
            $q->where('sender_id', $target->id)->where('receiver_id', $viewer->id);
        })->first();

        if (!$friendship) {
            return null;
        }

        if ($friendship->status === 'accepted') {
            return 'friends';
        }

        if ($friendship->status === 'pending') {
            return $friendship->sender_id === $viewer->id ? 'request_sent' : 'request_received';
        }

        return $friendship->status;
    }
}
