<?php

namespace Modules\Auth\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Actions\RegisterUserAction;
use Modules\Auth\Http\Requests\Api\v1\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth::register');
    }

    /**
     * Handle the registration request.
     */
    public function register(RegisterRequest $request, RegisterUserAction $registerUserAction)
    {
        // Reuse the same action logic!
        $result = $registerUserAction->execute($request->validated());

        // Log the user in for web session
        Auth::login($result['user']);

        return redirect()->route('dashboard')->with('success', 'Welcome to ZenGfy!');
    }
}
