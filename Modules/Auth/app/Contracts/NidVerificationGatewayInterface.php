<?php

namespace Modules\Auth\Contracts;

interface NidVerificationGatewayInterface
{
    /**
     * Verify NID number and date of birth against the National Identity Registry.
     *
     * @param string $nidNumber 10-digit Smart NID or 17-digit legacy NID
     * @param string $dob Date of birth formatted as YYYY-MM-DD
     * @return array Verification payload containing success, citizen details or error message
     */
    public function verify(string $nidNumber, string $dob): array;
}
