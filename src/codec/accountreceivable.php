<?php
    namespace Interswitch\codec;

    class AccountReceivable {

        public $accountNumber;
        public $accountType;

        public function __construct($num, $type){
            $this->accountNumber = $num;
            $this->accountType = $type;
        }
    }
?>