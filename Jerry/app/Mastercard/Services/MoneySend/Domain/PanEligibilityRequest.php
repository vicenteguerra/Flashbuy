<?php

namespace Mastercard\Services\MoneySend\Domain; 

class PanEligibilityRequest {

    private $SendingAccountNumber;
    private $ReceivingAccountNumber;

    public function setReceivingAccountNumber($ReceivingAccountNumber)
    {
        $this->ReceivingAccountNumber = $ReceivingAccountNumber;
    }

    public function getReceivingAccountNumber()
    {
        return $this->ReceivingAccountNumber;
    }

    public function setSendingAccountNumber($SendingAccountNumber)
    {
        $this->SendingAccountNumber = $SendingAccountNumber;
    }

    public function getSendingAccountNumber()
    {
        return $this->SendingAccountNumber;
    }
}