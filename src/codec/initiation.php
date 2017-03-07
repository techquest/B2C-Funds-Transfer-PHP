<?php
    namespace Interswitch\codec;

    class Initiation{

        public $amount;
        public $currencyCode;
        public $paymentMethodCode;
        public $channel;

        public function __construct($amount, $currencyCode, $paymentMethodCode, $channel) {
            //empty
            $this->amount = $amount;
            $this->currencyCode = $currencyCode;
            $this->paymentMethodCode = $paymentMethodCode;
            $this->channel = $channel;
        }

        
    }
?>