<?php

namespace Mastercard\Services\MoneySend\Domain; 

class DeleteSubscriberId {

    private $RequestId;

    public function setRequestId($RequestId)
    {
        $this->RequestId = $RequestId;
    }

    public function getRequestId()
    {
        return $this->RequestId;
    }
}