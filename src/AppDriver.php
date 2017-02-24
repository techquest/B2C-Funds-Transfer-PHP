<?php
    use Interswitch\Interswitch;
    use Interswitch\transfer\fundtransfer;
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

    var_dump($bankResponseCode);
    if($bankResponseCode == 200) {
        
        $cbnCode = $bankResponseBody->banks[0]->cbnCode;// central bank code
        $bankName = $bankResponseBody->banks[0]->bankName;// bank Name
        $bankCode = $bankResponseBody->banks[0]->bankCode;// bankcode in alphabetical form: UBA, GTB, FBN

        echo $cbnCode." ".$bankName." ".$bankCode."\n"; //printed response
    }
    
?>