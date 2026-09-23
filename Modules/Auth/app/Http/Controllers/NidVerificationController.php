<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Auth\Contracts\NidVerificationGatewayInterface;
use Modules\Auth\Events\NidVerified;

class NidVerificationController extends Controller
{
    protected NidVerificationGatewayInterface $gateway;

    public function __construct(NidVerificationGatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Verify citizen National ID and apply AES-256 PII encryption & blue badge.
     */
    public function verify(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nid_number' => ['required', 'string', 'regex:/^(\d{10}|\d{17})$/'],
            'date_of_birth' => ['required', 'date_format:Y-m-d'],
        ], [
            'nid_number.regex' => 'NID number must be either 10 digits (Smart NID) or 17 digits.',
            'date_of_birth.date_format' => 'Date of birth must be formatted as YYYY-MM-DD.',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationError($validator->errors());
        }

        $user = $request->user();

        // 1. Guard against duplicate verification on same account
        if ($user->nid_verified) {
            return ApiResponse::error(
                'This account is already NID verified.',
                400,
                null,
                'ALREADY_VERIFIED'
            );
        }

        $nidNumber = trim($request->input('nid_number'));
        $dob = trim($request->input('date_of_birth'));

        // 2. Cryptographic Blind Index Duplicate Detection
        $nidHash = User::generateNidHash($nidNumber);
        $duplicateUser = User::where('nid_hash', $nidHash)
            ->where('id', '!=', $user->id)
            ->first();

        if ($duplicateUser) {
            return ApiResponse::error(
                'This National ID is already linked to another registered citizen account.',
                409,
                null,
                'NID_ALREADY_CLAIMED'
            );
        }

        // 3. Verify against Government Registry Sandbox Gateway
        $gatewayResult = $this->gateway->verify($nidNumber, $dob);

        if (! $gatewayResult['success']) {
            $errorCode = $gatewayResult['error_code'] ?? 'VERIFICATION_FAILED';
            $status = ($errorCode === 'GATEWAY_TIMEOUT') ? 503 : 422;

            return ApiResponse::error(
                $gatewayResult['message'],
                $status,
                null,
                $errorCode
            );
        }

        // 4. Save PII Encrypted at Rest (AES-256) and apply Blue Badge
        $user->nid_number = $nidNumber;
        $user->nid_hash = $nidHash;
        $user->date_of_birth = $dob;
        $user->nid_verified = true;
        $user->verified_badge = true;
        $user->nid_verified_at = now();
        $user->save();

        $maskedNid = $user->maskedNid();

        // 5. Dispatch Domain Event
        event(new NidVerified($user, $maskedNid, $user->nid_verified_at->toIso8601String()));

        return ApiResponse::success([
            'nid_verified' => true,
            'verified_badge' => true,
            'masked_nid' => $maskedNid,
            'nid_verified_at' => $user->nid_verified_at->toIso8601String(),
            'citizen_name' => $gatewayResult['citizen_name_en'] ?? null,
            'status' => 'VERIFIED',
        ], 'National ID verified successfully. Blue badge issued.');
    }

    /**
     * Retrieve current user's NID verification and badge status.
     */
    public function status(Request $request): JsonResponse
    {
        $user = $request->user();

        return ApiResponse::success([
            'nid_verified' => (bool) $user->nid_verified,
            'verified_badge' => (bool) $user->verified_badge,
            'masked_nid' => $user->maskedNid(),
            'nid_verified_at' => $user->nid_verified_at?->toIso8601String(),
            'date_of_birth' => $user->date_of_birth?->format('Y-m-d'),
        ], 'NID verification status retrieved successfully');
    }
}
