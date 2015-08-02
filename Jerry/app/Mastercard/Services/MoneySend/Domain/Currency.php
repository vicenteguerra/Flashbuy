<?php

namespace App\Mastercard\Services\MoneySend\Domain; 

class Currency {

    private $AlphaCurrencyCode;
    private $NumericCurrencyCode;

    /**
     * @param mixed $AlphaCurrencyCode
     */
    public function setAlphaCurrencyCode($AlphaCurrencyCode)
    {
        $this->AlphaCurrencyCode = $AlphaCurrencyCode;
    }

    /**
     * @return mixed
     */
    public function getAlphaCurrencyCode()
    {
        return $this->AlphaCurrencyCode;
    }

    /**
     * @param mixed $NumericCurrencyCode
     */
    public function setNumericCurrencyCode($NumericCurrencyCode)
    {
        $this->NumericCurrencyCode = $NumericCurrencyCode;
    }

    /**
     * @return mixed
     */
    public function getNumericCurrencyCode()
    {
        return $this->NumericCurrencyCode;
    }
}