<?php

namespace Modules\Main\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display the account settings page.
     */
    public function index()
    {
        return view('main::account');
    }
}
