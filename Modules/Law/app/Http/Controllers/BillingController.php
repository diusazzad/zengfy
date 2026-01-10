<?php

namespace Modules\Law\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function checkout(Request $request)
    {
        $user = $request->user();
        $plan = $request->query('plan', $user?->plan ?? 'basic');

        return view('law::billing.checkout', [
            'user' => $user,
            'plan' => $plan,
        ]);
    }

    public function complete(Request $request)
    {
        $user = $request->user();
        $plan = $request->input('plan', $user?->plan ?? 'basic');

        if ($user) {
            $user->forceFill([
                'plan' => $plan,
                'account_status' => 'active',
            ])->save();
        }

        return redirect()->route('law.dashboard')->with('status', 'Payment completed. Your account is now active.');
    }
}
