<?php

namespace Mastercard\Services\MoneySend\Domain; 

class UpdateMapping {

    private $RequestId;
    private $Mapping;

    public function setMapping($Mapping)
    {
        $this->Mapping = $Mapping;
    }

    public function getMapping()
    {
        return $this->Mapping;
    }

    public function setRequestId($RequestId)
    {
        $this->RequestId = $RequestId;
    }

    public function getRequestId()
    {
        return $this->RequestId;
    }
}