<?php
declare(strict_types=1);

namespace App\Models;

use Iban\Validation\Iban;

class IBANDetailsModel
{
    protected string $ibanNumber;
    protected string $bban;
    protected string $bankIdentifier;

    public function __construct(Iban $iban)
    {
        $this->ibanNumber = $iban->format(Iban::FORMAT_PRINT);
        $this->bban = $iban->bban();
        $this->bankIdentifier = $iban->bbanBankIdentifier();
    }

    public function getIbanNumber(): string
    {
        return $this->ibanNumber;
    }

    public function getBban(): string
    {
        return $this->bban;
    }

    public function getBankIdentifier(): string
    {
        return $this->bankIdentifier;
    }

}