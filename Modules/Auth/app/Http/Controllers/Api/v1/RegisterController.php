<?php

namespace Modules\Auth\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\Auth\Http\Requests\Api\v1\RegisterRequest;
use Modules\Auth\Actions\RegisterUserAction;
use Modules\Auth\Transformers\UserResource;

class RegisterController extends Controller
{
    /**
     * Handle the incoming registration request.
     */
    public function register(RegisterRequest $request, RegisterUserAction $registerUserAction): JsonResponse
    {
        $result = $registerUserAction->execute($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully',
            'data' => [
                'user' => new UserResource($result['user']),
                'token' => $result['token'],
            ]
        ], 201);
    }
}
