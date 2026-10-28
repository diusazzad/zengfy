<?php

namespace Modules\Social\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostMedia extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'post_media';

    protected $fillable = [
        'post_id',
        'media_type',
        'url',
        'storage_path',
        'mime_type',
        'file_size_bytes',
        'width',
        'height',
        'order_column',
    ];

    protected $casts = [
        'file_size_bytes' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
        'order_column' => 'integer',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
