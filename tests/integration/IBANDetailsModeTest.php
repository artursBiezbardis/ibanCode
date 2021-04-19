<?php

use Iban\Validation\Iban;
use PHPUnit\Framework\TestCase;

class IBANDetailsModelTest extends TestCase
{

    public function testIbanDetailsModel(): void
    {
        $ibanDetails = new App\Models\IBANDetailsModel((new Iban('AL35202111090000000001234567')));

        $this->stringContains($ibanDetails->getIbanNumber(), true);
        $this->stringContains($ibanDetails->getBban(), true);
        $this->stringContains($ibanDetails->getBankIdentifier(), true);
        $this->assertEquals('202111090000000001234567', $ibanDetails->getBban());
        $this->assertEquals('202', $ibanDetails->getBankIdentifier());

    }


}
