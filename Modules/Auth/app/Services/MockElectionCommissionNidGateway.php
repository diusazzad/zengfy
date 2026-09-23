<?php

namespace Modules\Auth\Services;

use Modules\Auth\Contracts\NidVerificationGatewayInterface;

class MockElectionCommissionNidGateway implements NidVerificationGatewayInterface
{
    /**
     * Verify NID number and date of birth against the simulated government registry.
     */
    public function verify(string $nidNumber, string $dob): array
    {
        $cleanNid = trim($nidNumber);
        $cleanDob = trim($dob);

        // 1. Format Validation: 10 digits (Smart NID) or 17 digits (Legacy NID)
        if (! preg_match('/^(\d{10}|\d{17})$/', $cleanNid)) {
            return [
                'success' => false,
                'error_code' => 'INVALID_FORMAT',
                'message' => 'NID number must be either 10 digits (Smart NID) or 17 digits.',
            ];
        }

        // 2. Date of Birth Validation
        if (! preg_match('/^\d{4}-\d{2}-\d{2}$/', $cleanDob)) {
            return [
                'success' => false,
                'error_code' => 'INVALID_DOB',
                'message' => 'Invalid date of birth format. Required format: YYYY-MM-DD.',
            ];
        }

        // 3. Simulated Sandbox Test Triggers:
        // NID starting with 999 simulates unregistered/non-existent record
        if (str_starts_with($cleanNid, '999')) {
            return [
                'success' => false,
                'error_code' => 'NOT_FOUND',
                'message' => 'NID record not found in Election Commission database.',
            ];
        }

        // NID starting with 888 simulates government server downtime
        if (str_starts_with($cleanNid, '888')) {
            return [
                'success' => false,
                'error_code' => 'GATEWAY_TIMEOUT',
                'message' => 'Government NID Verification Server is temporarily unreachable. Please retry later.',
            ];
        }

        // 4. Successful Verification Payload
        return [
            'success' => true,
            'citizen_name_en' => 'Citizen ' . substr($cleanNid, -4),
            'citizen_name_bn' => 'নাগরিক ' . substr($cleanNid, -4),
            'nid_number' => $cleanNid,
            'date_of_birth' => $cleanDob,
            'gender' => 'MALE',
            'status' => 'ACTIVE',
            'verified_source' => 'Bangladesh Election Commission (Simulated)',
        ];
    }
}
