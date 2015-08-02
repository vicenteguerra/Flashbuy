<?php

namespace App\Mastercard\Services\MoneySend\Domain; 

class PanEligibility {

    private $RequestId;
    private $SendingEligibility;
    private $ReceivingEligibility;

    public function setReceivingEligibility($ReceivingEligibility)
    {
        $this->ReceivingEligibility = $ReceivingEligibility;
    }

    public function getReceivingEligibility()
    {
        return $this->ReceivingEligibility;
    }

    public function setRequestId($RequestId)
    {
        $this->RequestId = $RequestId;
    }

    public function getRequestId()
    {
        return $this->RequestId;
    }

    public function setSendingEligibility($SendingEligibility)
    {
        $this->SendingEligibility = $SendingEligibility;
    }

    public function getSendingEligibility()
    {
        return $this->SendingEligibility;
    }
}