<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    /**
     * Handle high-concurrency enterprise user registration.
     */
    public function register(Request $request): JsonResponse
    {
        // 1. Strict Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. Idempotency Check (Prevent duplicate submissions on network lag)
        $idempotencyKey = $request->header('X-Idempotency-Key');
        if ($idempotencyKey && Cache::has("idempotency:{$idempotencyKey}")) {
            return response()->json(Cache::get("idempotency:{$idempotencyKey}"), 200);
        }

        try {
            // 3. Database Transaction (Atomic Operation)
            $responsePayload = DB::transaction(function () use ($request) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                // Create Sanctum API Token
                $token = $user->createToken('auth_token')->plainTextToken;

                return [
                    'success' => true,
                    'message' => 'User registered successfully',
                    'data' => [
                        'user' => [
                            'id' => $user->id, // UUID
                            'name' => $user->name,
                            'email' => $user->email,
                        ],
                        'token' => $token,
                    ]
                ];
            });

            // Cache response if Idempotency Key provided (valid for 5 minutes)
            if ($idempotencyKey) {
                Cache::put("idempotency:{$idempotencyKey}", $responsePayload, now()->addMinutes(5));
            }

            return response()->json($responsePayload, 201);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed due to a server error.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
