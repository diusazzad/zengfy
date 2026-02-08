<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return \Modules\Main\Database\Factories\CommentFactory::new();
    }

    protected $connection = 'main';

    protected $fillable = [
        'user_id',
        'post_id',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
