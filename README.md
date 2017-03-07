#B2C-Funds-Transfer-PHP
```
<?php
    use Interswitch\Interswitch;
    use Interswitch\transfer\fundtransfer;
    use Interswitch\transfer\transferrequestbuilder;
    require_once __DIR__ . '/../vendor/autoload.php';

    $initiatingEntityCode = "PBL";
    //test clientId and clientSecret
    //$clientId = "IKIA2EFBE1EF63D1BBE2AF6E59100B98E1D3043F477A";
    //$clientSecret = "uAk0Amg6NQwQPcnb9BTJzxvMS6Vz22octQglQ1rfrMA=";
    
    // sandbox clienId client
    $clientId = "IKIA6570778A3484D6F33BC7E4165ADCA6CF06B2860A";
    $clientSecret = "DXfUwpuIvMAKN84kv38uspqGOsStgFS0oZMjU7bPwpU=";
    

    
    /***- START- ***/

    /**
    * Interswitch.ENV_SANDBOX, is for sandbox environment
    * 
    * Interswitch.ENV_PROD, is for production environment
    */
    $transfer = new FundsTransfer($clientId,$clientSecret,Interswitch::ENV_SANDBOX);
    //$transfer = new FundTransfer($clientId, $clientSecret, Interswitch::ENV_PRODUCTION); // Production
    //$transfer = new FundTransfer($clientId, $clientSecret); // Defaults to Sandbox
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
            ->amount("100000") // mandatory, minor denomination
            ->channel(FundsTransfer.LOCATION) // mandatory: ATM-1, POS-2, WEB-3, MOBILE-4, KIOSK-5, PCPOS-6, LOCATION-7, DIRECT DEBIT-8
            ->destinationBankCode(cbnCode)/* mandatory:  To be gotten from the get all banks code (transfer.fetchBanks())*/
            ->toAccountNumber("0114951936") // mandatory
            ->requestRef("60360575603527")// mandatory
            ->senderPhoneNumber("07036913492") // optional
            ->senderEmail("grandeur_man@yahoo.com") // optional
            ->senderLastName("Desmond") // optional
            ->senderOtherNames("Samuel") // optional
            ->receiverPhoneNumber("07036913492") // optional
            ->receiverEmail("grandeur_man@yahoo.com") // optional
            ->receiverLastName("Desmond") // optional
            ->receiverOtherNames("Samuel") // optional
            ->fee("10000")// optional (minor denomination)
            ->build();


             $validationResponse = $transfer->validateAccount($request);

             if($validationResponse["HTTP_CODE"] === 200) {
                 $accountName =json_decode($validationResponse["RESPONSE_BODY"])->accountName;
                 echo "Account Name is ".$accountName;
             }
             else if(!$validationResponse["HTTP_CODE"] || $validationResponse["HTTP_CODE"] != 200) {
                 //account validation was not successful, continue on
             }

             $response = $transfer->send($request);
             if($response["HTTP_CODE"] === 200) {
                 $responseBody = json_decode($response["RESPONSE_BODY"]);
                 $mac = $responseBody->mac;
                 $transactionDate = $responseBody->transactionDate;
                 $responseCode = $responseBody->responseCode;
                 echo $mac." ".$transactionDate." ".$responseCode;
             }
             else if(!$response["HTTP_CODE"] || $response["HTTP_CODE"] != 200) {
                 var_dump($response);
             }
             
    }
    
?>
```
