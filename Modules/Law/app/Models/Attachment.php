<?php

namespace Modules\Law\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    /** @use HasFactory<\Database\Factories\AttachmentFactory> */
    use HasFactory;

    protected $fillable = [
        'case_id',
        'file_path',
        'file_name',
    ];

    public function case()
    {
        return $this->belongsTo(CaseModel::class);
    }
}
