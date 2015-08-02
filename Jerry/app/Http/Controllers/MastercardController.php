<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;

//Master Card
use App\Mastercard\Common\Environment;
use App\Mastercard\Env;

use App\Mastercard\Services\MoneySend\Services\TransferService;

use App\Mastercard\Services\MoneySend\Domain\Transfer; 
use App\Mastercard\Services\MoneySend\Domain\TransferRequest;
use App\Mastercard\Services\MoneySend\Domain\FundingCard; 
use App\Mastercard\Services\MoneySend\Domain\FundingMapped; 
use App\Mastercard\Services\MoneySend\Domain\FundingAmount; 
use App\Mastercard\Services\MoneySend\Domain\ReceiverAddress; 
use App\Mastercard\Services\MoneySend\Domain\SenderAddress; 
use App\Mastercard\Services\MoneySend\Domain\ReceivingCard; 
use App\Mastercard\Services\MoneySend\Domain\ReceivingMapped; 
use App\Mastercard\Services\MoneySend\Domain\ReceivingAmount; 
use App\Mastercard\Services\MoneySend\Domain\CardAcceptor; 


class MastercardController extends Controller {

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function transaction()
    {
        $testUtils = new ENV(Environment::SANDBOX);
        $cardMappingService = new TransferService(
        ENV::SANDBOX_CONSUMER_KEY, 
        $testUtils->getPrivateKey(), 
        Environment::SANDBOX);

        $transferRequestCard = new TransferRequest();
        $transferRequestCard->setLocalDate("1212");
        $transferRequestCard->setLocalTime("161222");
        $transferRequestCard->setTransactionReference("40000000010101020". rand(10,90));
        $transferRequestCard->setSenderName("John Doe");

        $address = new SenderAddress();
        $address->setLine1("123 Main Street");
        $address->setLine2("#5A");
        $address->setCity("Arlington");
        $address->setCountrySubdivision("VA");
        $address->setPostalCode(22207);
        $address->setCountry("USA");
        $transferRequestCard->setSenderAddress($address);

        $fundingCard = new FundingCard();
        $fundingCard->setAccountNumber("5184680430000006");
        $fundingCard->setExpiryMonth(11);
        $fundingCard->setExpiryYear(2015);
        $transferRequestCard->setFundingCard($fundingCard);
        $transferRequestCard->setFundingUCAF("MjBjaGFyYWN0ZXJqdW5rVUNBRjU=1111");
        $transferRequestCard->setFundingMasterCardAssignedId(123456);

        $fundingAmount = new FundingAmount();
        $fundingAmount->setValue(15000);
        $fundingAmount->setCurrency(840);
        $transferRequestCard->setFundingAmount($fundingAmount);
        $transferRequestCard->setReceiverName("Jose Lopez");

        $receiverAddress = new ReceiverAddress();
        $receiverAddress->setLine1("Pueblo Street");
        $receiverAddress->setLine2("PO BOX 12");
        $receiverAddress->setCity("El PASO");
        $receiverAddress->setCountrySubdivision("TX");
        $receiverAddress->setPostalCode(79906);
        $receiverAddress->setCountry("USA");
        $transferRequestCard->setReceiverAddress($receiverAddress);
        $transferRequestCard->setReceiverPhone("1800639426");

        $receivingCard = new ReceivingCard();
        $receivingCard->setAccountNumber("5184680430000006");
        $transferRequestCard->setReceivingCard($receivingCard);

        $receivingAmount = new ReceivingAmount();
        $receivingAmount->setValue(182206);
        $receivingAmount->setCurrency(484);
        $transferRequestCard->setReceivingAmount($receivingAmount);
        $transferRequestCard->setChannel("W");
        $transferRequestCard->setUCAFSupport("false");
        $transferRequestCard->setICA("009674");
        $transferRequestCard->setProcessorId("9000000442");
        $transferRequestCard->setRoutingAndTransitNumber(990442082);

        $cardAcceptor = new CardAcceptor();
        $cardAcceptor->setName("My Local Bank");
        $cardAcceptor->setCity("Saint Louis");
        $cardAcceptor->setState("MO");
        $cardAcceptor->setPostalCode(63101);
        $cardAcceptor->setCountry("USA");
        $transferRequestCard->setCardAcceptor($cardAcceptor);
        $transferRequestCard->setTransactionDesc("A2A");
        $transferRequestCard->setMerchantId(123456);

        $transfer = $cardMappingService->getTransfer($transferRequestCard);
        //var_dump(get_class_methods($transfer));die;

        if(null != $transfer) {
        var_dump($transfer->getTransactionHistory());die;
        }

        var_dump($transfer);die;
    }
}