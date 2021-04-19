<?php
declare(strict_types=1);

namespace App\Models;

class IBANCountryModel
{
    private string $country;
    private string $capitalCity;
    private array $currencyInfo;

    public function __construct(string $countryCode)
    {
        $countryDetails = self::getAPIData($countryCode);
        $this->country = $countryDetails['name'];
        $this->capitalCity = $countryDetails['capitalCity'];
        $this->currencyInfo = $countryDetails['currencyDetails'];
    }

    public function getAPIData($countryCode): array
    {
        $apiUrl = 'https://restcountries.eu/rest/v2/alpha/' . $countryCode;

        $allCountryDetails = json_decode(file_get_contents($apiUrl), true);
        $countryDetails = [];
        $countryDetails['name'] = $allCountryDetails['name'];
        $countryDetails['capitalCity'] = $allCountryDetails['capital'];
        foreach ($allCountryDetails['currencies'] as $currency) {
            $countryDetails['currencyDetails'][$currency['name']] = $currency;
        }
        return $countryDetails;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCapitalCity(): string
    {
        return $this->capitalCity;
    }

    public function getCurrencyInfo(): array
    {
        return $this->currencyInfo;
    }

}