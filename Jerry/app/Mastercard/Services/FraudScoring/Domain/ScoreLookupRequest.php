<?php
namespace Mastercard\Services\FraudScoring\Domain;

class ScoreLookupRequest
{
	private $TransactionDetail;

	function getTransactionDetail(){
		return $this->TransactionDetail;
	}

	function setTransactionDetail($value){
		return $this->TransactionDetail = $value;
	}

	function hasAttribute($attributeName){
		return property_exists($this, "_$attributeName");
	}
}

?>