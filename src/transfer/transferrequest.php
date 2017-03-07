<?php

    namespace Interswitch\transfer;

    class TransferRequest {

        public $initiatingEntityCode;
        public $sender;
        public $beneficiary;
        public $accountNumber;
        public $surcharge;
        public $bankCode;
        public $transferCode;
        public $termination;
        public $initiation;
        public $mac;

        public function __construct(){

            
        }

        public function setEntityCode($val) {
            $this->initiatingEntityCode = $val;
        }
        public function setSender($val) {
            $this->sender = $val;
        }
        public function setBeneficiary($val) {
            $this->beneficiary = $val;
        }
        public function setTermination($val) {
            $this->termination = $val;
        }
        public function setAccountReceivable($val) {
            $this->termination->accountReceivable = $val;
        }
        public function setInitiation($val) {
            $this->initiation = $val;
        }
        public function getBankCode(){
            return $this->bankCode;
        }
        public function getAccountNumber() {
            return $this->accountNumber;
        }
        public function getInitiation(){
            return $this->initiation;
        }
        public function getTermination(){
            return $this->termination;
        }
        public function mac($val) {
            $this->mac = $val;
        }

    }
?>