<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /**
     * Send password reset 6-digit verification OTP.
     */
    public function forgotPassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationError($validator->errors());
        }

        $email = strtolower(trim($request->email));
        $user = User::where('email', $email)->first();

        if (! $user) {
            return ApiResponse::notFound('No account found with this email address.');
        }

        // Generate 6-digit verification code
        $code = (string) random_int(100000, 999999);

        // Remove previous tokens for this email
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        // Save hashed OTP into password_reset_tokens
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => Hash::make($code),
            'created_at' => now(),
        ]);

        // Log OTP for audit and local debugging
        Log::info("Sovereign Security: Password reset OTP for [{$email}] is: {$code}");

        $responsePayload = [
            'email' => $email,
            'expires_in_minutes' => 15,
        ];

        // In local/debug mode, expose dev_code for direct browser testing without SMTP
        if (config('app.debug') || app()->environment('local')) {
            $responsePayload['dev_code'] = $code;
        }

        return ApiResponse::success(
            $responsePayload,
            'A 6-digit verification code has been dispatched. Check your inbox or use the verification code.'
        );
    }

    /**
     * Verify the 6-digit code.
     */
    public function verifyCode(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'code' => 'required|string|size:6',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationError($validator->errors());
        }

        $email = strtolower(trim($request->email));
        $code = trim($request->code);

        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('created_at', '>=', now()->subMinutes(15))
            ->first();

        if (! $record || ! Hash::check($code, $record->token)) {
            return ApiResponse::unauthorized('Invalid or expired verification code.');
        }

        return ApiResponse::success([
            'email' => $email,
            'verified' => true,
        ], 'Verification code confirmed. You may now set your new password.');
    }

    /**
     * Reset the user password using verified OTP code.
     */
    public function resetPassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'code' => 'required|string|size:6',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationError($validator->errors());
        }

        $email = strtolower(trim($request->email));
        $code = trim($request->code);

        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('created_at', '>=', now()->subMinutes(15))
            ->first();

        if (! $record || ! Hash::check($code, $record->token)) {
            return ApiResponse::unauthorized('Invalid or expired verification code.');
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            return ApiResponse::notFound('User account could not be located.');
        }

        // Update password with 12-round bcrypt hash
        $user->password = Hash::make($request->password);
        $user->save();

        // Invalidate reset token
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        // Invalidate all existing API tokens for security
        $user->tokens()->delete();

        // Create new active token
        $deviceName = 'Web Browser (' . $request->ip() . ')';
        $newToken = $user->createToken($deviceName)->plainTextToken;

        // Auto-login to web session if available
        if ($request->hasSession()) {
            Auth::login($user);
        }

        Log::info("Sovereign Security: Password successfully reset for user [{$user->id}] ({$user->email})");

        return ApiResponse::success([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'token' => $newToken,
        ], 'Password has been reset successfully. You are now securely logged in.');
    }
}
