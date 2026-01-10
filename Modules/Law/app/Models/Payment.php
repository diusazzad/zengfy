<?php

namespace Modules\Law\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    protected $fillable = [
        'case_id',
        'amount',
        'payment_date',
    ];

    protected $dates = ['payment_date'];

    public function case()
    {
        return $this->belongsTo(CaseModel::class);
    }
}
