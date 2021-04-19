<?php

use App\Models\ValidationModel;
use PHPUnit\Framework\TestCase;

class ValidationModelTest extends TestCase
{

    public function testValidationModel(): void
    {
        $validateIbanCode = new ValidationModel();

        $this->assertIsArray($validateIbanCode->validateIBANCode('AL35202111090000000001234567'));
        $this->assertIsArray($validateIbanCode->validateIBANCode('AL35202'));
        $this->assertIsArray($validateIbanCode->validateIBANCode(true));
        $this->assertEquals(true, $validateIbanCode->validateIBANCode('AL35202111090000000001234567')['status']);
        $this->assertEquals(false, $validateIbanCode->validateIBANCode('AL35202110000001234567')['status']);

        $this->assertEquals(true, $validateIbanCode->validateAPIConnection('LV'));
        $this->assertEquals(false, $validateIbanCode->validateAPIConnection('VLCD'));


    }

}