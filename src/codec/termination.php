<?php
    namespace Interswitch\codec;

    class Termination{

        public $accountReceivable;
        public $amount;
        public $entityCode;
        public $currencyCode;
        public $paymentMethodCode;
        public $countryCode;

        public function __construct($amount, $entityCode, $currencyCode, $paymentMethodCode, $countryCode) {
            //empty
            $this->amount = $amount;
            $this->entityCode = $entityCode;
            $this->currencyCode = $currencyCode;
            $this->paymentMethodCode = $paymentMethodCode;
            $this->countryCode = $countryCode;
        }

        
    }
?>