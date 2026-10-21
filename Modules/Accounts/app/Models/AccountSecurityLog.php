<?php

namespace Modules\Accounts\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AccountSecurityLog extends Model
{
    protected $table = 'account_security_logs';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'event_type',
        'ip_address',
        'device_name',
        'location',
        'status',
        'details',
        'created_at',
    ];

    protected $casts = [
        'details' => 'array',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
