<?php 
    namespace Interswitch\transfer;

    class FundTransfer {

        private $clientId;
        private $clientSecret;
        private $environment;

        public function __construct($clientId="", $clientSecret="", $env="SANDBOX"){
            echo "creating class ";
            $this->clientId = $clientId;
            $this->clientSecret = $clientSecret;
            $this->environment = $env;
        }
    }
?>