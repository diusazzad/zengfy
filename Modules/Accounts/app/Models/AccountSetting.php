<?php

namespace Modules\Accounts\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AccountSetting extends Model
{
    protected $table = 'account_settings';

    protected $fillable = [
        'user_id',
        'theme',
        'locale',
        'two_factor_enabled',
        'two_factor_method',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'recovery_email',
        'recovery_phone',
        'login_alerts',
        'extra_attributes',
    ];

    protected $casts = [
        'two_factor_enabled' => 'boolean',
        'two_factor_confirmed_at' => 'datetime',
        'two_factor_recovery_codes' => 'array',
        'login_alerts' => 'boolean',
        'extra_attributes' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
