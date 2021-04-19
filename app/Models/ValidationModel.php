<?php
declare(strict_types=1);

namespace App\Models;

use Iban\Validation\Iban;
use Iban\Validation\Validator;

class ValidationModel
{
    public function validateIBANCode(string $ibanCode): array
    {
        $validation = ['status' => true];
        $iban = new Iban($ibanCode);
        $validator = new Validator();

        if (!$validator->validate($iban)) {
            $validation['status'] = $validator->validate($iban);
            foreach ($validator->getViolations() as $key => $violation) {
                $validation[$key] = $violation;
            }
        }
        return $validation;
    }

    public function validateAPIConnection(string $countryCode): bool
    {
        $apiUrl = 'https://restcountries.eu/rest/v2/alpha/' . $countryCode;
        $headers = @get_headers($apiUrl);
        if ($headers && strpos($headers[0], '200')) {
            $status = true;
        } else {
            $status = false;
        }
        return $status;
    }

}