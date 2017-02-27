<?php
    use Interswitch\Interswitch;
    use Interswitch\transfer\fundtransfer;
    use Interswitch\transfer\transferrequestbuilder;
    require_once __DIR__ . '/../vendor/autoload.php';

    $initiatingEntityCode = "PBL";
    $clientId = "IKIA2EFBE1EF63D1BBE2AF6E59100B98E1D3043F477A";
    $clientSecret = "uAk0Amg6NQwQPcnb9BTJzxvMS6Vz22octQglQ1rfrMA=";

    
    /***- START- ***/

    /**
    * Interswitch.ENV_SANDBOX, is for sandbox environment
    * 
    * Interswitch.ENV_PROD, is for production environment
    */
    $transfer = new FundTransfer($clientId,$clientSecret,Interswitch::ENV_DEV);

    $bankResponse = $transfer->fetchBanks();

    $bankResponseCode = json_decode($bankResponse["HTTP_CODE"]);
    $bankResponseBody = json_decode($bankResponse["RESPONSE_BODY"]);

    
    if($bankResponseCode == 200) {
        
        $cbnCode = $bankResponseBody->banks[0]->cbnCode;// central bank code
        $bankName = $bankResponseBody->banks[0]->bankName;// bank Name
        $bankCode = $bankResponseBody->banks[0]->bankCode;// bankcode in alphabetical form: UBA, GTB, FBN

        echo $cbnCode." ".$bankName." ".$bankCode."\n"; //printed response

        //build transfer request
        $request = (new TransferRequestBuilder($initiatingEntityCode))
             ->senderPhoneNumber("07036913492") // optional
             ->senderEmail("grandeur_man@yahoo.com") // optional
             ->senderLastName("Desmond") // optional
             ->senderOtherNames("Samuel") // optional
             ->receiverPhoneNumber("07036913492") // optional
             ->receiverEmail("grandeur_man@yahoo.com") // optional
             ->receiverLastName("Desmond") // optional
             ->receiverOtherNames("Samuel") // optional
             ->amount("100000") // mandatory, minor denomination
             ->channel(FundTransfer::LOCATION) // mandatory: ATM-1, POS-2, WEB-3, MOBILE-4, KIOSK-5, PCPOS-6, LOCATION-7, DIRECT DEBIT-8
             ->destinationBankCode($cbnCode)/* mandatory:  To be gotten from the get all banks code*/
             ->toAccountNumber("0114951936") // mandatory
             ->fee("10000")// optional
             ->requestRef("60360575603527")// mandatory
             ->build();

             $validationResponse = $transfer->validateAccount($request);

             if($validationResponse["HTTP_CODE"] === 200) {
                 $accountName =json_decode($validationResponse["RESPONSE_BODY"])->accountName;
                 echo "Account Name is ".$accountName;
             }
             else if(!$validationResponse["HTTP_CODE"] || $validationResponse["HTTP_CODE"] != 200) {
                 //account validation was not successful, continue on
             }
             
    }
    
?>