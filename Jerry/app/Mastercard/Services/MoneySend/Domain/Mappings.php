<?php

namespace Mastercard\Services\MoneySend\Domain; 

class Mappings {

    private $Mapping;

    public function setMapping($Mapping)
    {
        $this->Mapping = $Mapping;
    }

    public function getMapping()
    {
        return $this->Mapping;
    }
}