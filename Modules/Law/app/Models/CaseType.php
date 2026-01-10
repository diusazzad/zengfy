<?php

namespace Modules\Law\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseType extends Model
{
    /** @use HasFactory<\Database\Factories\CaseTypeFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function cases()
    {
        return $this->hasMany(CaseModel::class);
    }
}
