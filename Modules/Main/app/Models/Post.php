<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return \Modules\Main\Database\Factories\PostFactory::new();
    }

    protected $connection = 'main';

    protected $fillable = [
        'user_id',
        'body',
        'image_path',
        'likes_count',
        'comments_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
