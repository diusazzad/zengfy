<?php

namespace Modules\Law\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaseModel extends Model
{
    /** @use HasFactory<\Database\Factories\CaseModelFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'case_type_id',
        'court_id',
        'court_case_number',
        'case_title',
        'case_stage_id',
        'opening_date',
        'previous_date',
        'next_date',
        'client_name',
        'opponent_name',
        'opponent_lawyer',
        'case_fee',
        'notes',
        'office_file_number',
        'status',
        'share_token',
    ];

    protected $casts = [
        'opening_date' => 'date',
        'previous_date' => 'date',
        'next_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function caseType()
    {
        return $this->belongsTo(CaseType::class);
    }

    public function caseStage()
    {
        return $this->belongsTo(CaseStage::class);
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
