<?php

namespace Modules\Social\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'content',
        'post_type',
        'visibility',
        'ward_code',
        'thana_code',
        'district_code',
        'likes_count',
        'comments_count',
        'shares_count',
        'is_pinned',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
        'likes_count' => 'integer',
        'comments_count' => 'integer',
        'shares_count' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function media(): HasMany
    {
        return $this->hasMany(PostMedia::class, 'post_id')->orderBy('order_column', 'asc');
    }

    /**
     * Scope to public posts.
     */
    public function scopePublic(Builder $query): Builder
    {
        return $query->where('visibility', 'public');
    }

    /**
     * Scope posts visible to a specific viewer.
     */
    public function scopeVisibleTo(Builder $query, ?User $viewer = null): Builder
    {
        if (!$viewer) {
            return $query->where('visibility', 'public');
        }

        return $query->where(function (Builder $q) use ($viewer) {
            // Author can always see their own posts
            $q->where('user_id', $viewer->id)
                // Public posts are visible to all
                ->orWhere('visibility', 'public')
                // Friends-only posts are visible if viewer is friend with author
                ->orWhere(function (Builder $fq) use ($viewer) {
                    $fq->where('visibility', 'friends_only')
                        ->where(function (Builder $subQ) use ($viewer) {
                            $subQ->whereIn('user_id', function ($sub) use ($viewer) {
                                $sub->select('receiver_id')
                                    ->from('friendships')
                                    ->where('sender_id', $viewer->id)
                                    ->where('status', 'accepted');
                            })->orWhereIn('user_id', function ($sub) use ($viewer) {
                                $sub->select('sender_id')
                                    ->from('friendships')
                                    ->where('receiver_id', $viewer->id)
                                    ->where('status', 'accepted');
                            });
                        });
                });
        });
    }

    /**
     * Scope posts to a specific geographic ward / hyperlocal boundary.
     */
    public function scopeHyperlocal(Builder $query, ?string $wardCode = null, ?string $thanaCode = null, ?string $districtCode = null): Builder
    {
        if ($wardCode) {
            $query->where('ward_code', $wardCode);
        }
        if ($thanaCode) {
            $query->where('thana_code', $thanaCode);
        }
        if ($districtCode) {
            $query->where('district_code', $districtCode);
        }

        return $query;
    }
}
