<?php 
    namespace Interswitch\transfer;
    use Interswitch\Interswitch;
    use Interswitch\transfer;
    require_once __DIR__ . '/../../vendor/autoload.php';

    class FundTransfer {

        private $clientId;
        private $clientSecret;
        private $environment;
        private $interswitch;
        const ATM = "1";
        const WEB = "3";
        const MOBILE = "4";
        const KIOSK = "5";
        const PCPOS = "6";
        const POS = "2";
        const LOCATION = "7";
        const DIRECT_DEBIT = "8";

        public function __construct($clientId, $clientSecret, $env="SANDBOX"){
            
            $this->clientId = $clientId;
            $this->clientSecret = $clientSecret;
            $this->environment = $env;
            $this->interswitch = new Interswitch($clientId, $clientSecret, Interswitch::ENV_DEV);
        }

        public function send($transfer) {


        }

        public function fetchBanks() {
            $response = $this->interswitch->send(Constants::GET_ALL_BANKS_RESOURCE_URL, Constants::GET);
            return $response;
        }

        public function validateAccount($transfer){


        } 
    }
?>