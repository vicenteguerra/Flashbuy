<?php

namespace App\Mastercard\Services\MoneySend\Domain; 

class ReceivingCard {

    private $AccountNumber;

    /**
     * @param mixed $AccountNumber
     */
    public function setAccountNumber($AccountNumber)
    {
        $this->AccountNumber = $AccountNumber;
    }

    /**
     * @return mixed
     */
    public function getAccountNumber()
    {
        return $this->AccountNumber;
    }

}