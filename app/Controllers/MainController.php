<?php

namespace App\Controllers;


use App\Models\IBANCountryModel;
use App\Models\IBANDetailsModel;
use App\Models\ValidationModel;
use Iban\Validation\Iban;

class MainController
{

    public function getIbanInfo()
    {
        $validation = new ValidationModel();
        $exitLoop = readline('To start IBAN code check press Enter, To exit press "x" and than Enter: ');
        while (!$exitLoop == 'x' || !$exitLoop == 'X') {
            $ibanCodeInput = readline('Enter IBAN code: ');
            $ibanCodeValidation = $validation->validateIBANCode($ibanCodeInput);
            if ($ibanCodeValidation['status']) {
                $iban = new Iban($ibanCodeInput);
                $ibanDetailsObject = (new IBANDetailsModel($iban));
                print_r($ibanDetailsObject);
                if ($validation->validateAPIConnection($iban->countryCode())) {
                    $countryDetails = (new IBANCountryModel($iban->countryCode()));
                    PHP_EOL . print_r($countryDetails);
                } else {
                    print_r('Can\'t get country detail\'s from API') . PHP_EOL;
                }

            } else {
                foreach ($ibanCodeValidation as $kay => $violationInfo) {
                    if ($kay !== 'status') {
                        echo $violationInfo . PHP_EOL;
                    }
                }
            }
            $exitLoop = readline('To exit press "x" and than Enter, to start IBAN code check press Enter: ');
        }
        exit();
    }


}