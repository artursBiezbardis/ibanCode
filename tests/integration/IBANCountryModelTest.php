<?php

use App\Models\IBANCountryModel;
use PHPUnit\Framework\TestCase;

class IBANCountryModelTest extends TestCase
{

    public function testIbanCountryModel(): void
    {
        $countryDetails = new IBANCountryModel('LV');

        $this->assertIsString($countryDetails->getCountry());
        $this->assertIsString($countryDetails->getCapitalCity());
        $this->assertArrayHasKey('Euro', $countryDetails->getCurrencyInfo());
        $this->assertEquals('Latvia', $countryDetails->getCountry());
        $this->assertEquals('Riga', $countryDetails->getCapitalCity());
        $this->assertIsArray($countryDetails->getAPIData('LV'));

    }

}
