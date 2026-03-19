<?php

namespace Modules\Team\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'bio',
        'image_path',
        'linkedin_url',
        'twitter_url',
        'github_url',
        'facebook_url',
        'status',
        'order',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return asset('images/default-avatar.png');
    }
}
