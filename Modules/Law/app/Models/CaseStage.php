<?php

namespace Modules\Law\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStage extends Model
{
    /** @use HasFactory<\Database\Factories\CaseStageFactory> */
    use HasFactory;

     protected $fillable = ['name'];

    public function cases()
    {
        return $this->hasMany(CaseModel::class);
    }
}
