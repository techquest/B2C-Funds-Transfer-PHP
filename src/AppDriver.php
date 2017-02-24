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
    
?>