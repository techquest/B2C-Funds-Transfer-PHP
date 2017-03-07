<?php

    namespace Interswitch\transfer;
    use Interswitch\transfer\transferrequest;
    use Interswitch\transfer\constants;
    use Interswitch\codec\sender;
    use Interswitch\codec\beneficiary;
    use Interswitch\codec\accountreceivable;
    use Interswitch\codec\termination;
    use Interswitch\codec\initiation;

    class TransferRequestBuilder {

        private $transfer;
        private $initiatingEntityCode;

        private $senderPhone="-";
        private $senderEmailVal="-";
        private $senderLastNameVal="-";
        private $senderOtherNameVal="-";

        private $beneficiaryPhoneNumber;
        private $beneficiaryEmail;
        private $beneficiaryLastName;
        private $beneficiaryOtherNames;

        private $amountValue;

        private $initiatorChannel;

        private $terminationEntityCode;
        private $terminationAccountNumber;

        private $surcharge;
        private $transferCode;
        private $bankCode;
        private $accountNumber;

        private $initiatorCurrencyCode = Constants::CURRENCY_CODE;
        private $initiatorPaymentMethodCode = Constants::INITATION_PAYMENT_METHOD_CODE;
        private $terminationCurrencyCode = Constants::CURRENCY_CODE;
        private $terminationPaymentMethodCode = Constants::TERMINATION_PAYMENT_METHOD_CODE;
        private $terminationCountryCode = Constants::COUNTRY_CODE;
        private $terminationAccountType = Constants::ACCOUNT_TYPE;

        public function __construct($entityCode) {
            echo "constructing transferbuilder";
            $this->initiatingEntityCode = $entityCode;
            $this->transfer = new TransferRequest();
        }

        public function senderPhoneNumber($phone) {
            $this->senderPhone = $phone;
            return $this;
        }

        public function senderEmail($email) {
            $this->senderEmailVal = $email;
            return $this;
        }
        
        public function senderLastName($name){
            $this->senderLastNameVal = $name;
            return $this;
        }

        public function senderOtherNames($name) {
            $this->senderOtherNameVal = $name;
            return $this;
        }

        public function receiverPhoneNumber($val) {
            $this->beneficiaryPhoneNumber = $val;
            return $this;
        }
        public function receiverEmail($val) {
            $this->beneficiaryEmail = $val;
            return $this;
        }
        public function receiverLastName($val) {
            $this->beneficiaryLastName = $val;
            return $this;
        }
        public function receiverOtherNames($val) {
            $this->beneficiaryOtherNames = $val;
            return $this;
        }
        public function amount($val) {
            $this->amountValue = $val;
            return $this;
        }

        public function channel($val) {
            $this->initiatorChannel = $val;
            return $this;
        }

        public function destinationBankCode($val) {
            $this->terminationEntityCode = $val;
            return $this;
        }
        public function toAccountNumber($val) {
            $this->terminationAccountNumber = $val;
            return $this;
        }
        public function fee($val) {
            $this->surcharge = $val;
            return $this;
        }
        public function requestRef($val) {
            $this->transferCode = $val;
            return $this;
        }

        public function build(){
            
            $this->transfer->setEntityCode($this->initiatingEntityCode);
            $this->transfer->setSender(new Sender($this->senderPhone, $this->senderEmailVal, $this->senderLastNameVal, $this->senderOtherNameVal));
            $this->transfer->setBeneficiary(new Beneficiary($this->beneficiaryPhoneNumber, $this->beneficiaryEmail, $this->beneficiaryLastName, $this->beneficiaryOtherNames));
            $this->transfer->accountNumber = $this->terminationAccountNumber;
            $this->transfer->bankCode = $this->terminationEntityCode;
            $this->transfer->surcharge = $this->surcharge;
            $this->transfer->transferCode = $this->transferCode;
            $this->transfer->setTermination(new Termination($this->amountValue, $this->terminationEntityCode,$this->terminationCurrencyCode, $this->terminationPaymentMethodCode, $this->terminationCountryCode));
            $accountReceivable = new AccountReceivable($this->terminationAccountNumber, $this->terminationAccountType);
            $this->transfer->setAccountReceivable($accountReceivable);
            $this->transfer->setInitiation(new Initiation($this->amountValue, $this->initiatorCurrencyCode, $this->initiatorPaymentMethodCode, $this->initiatorChannel));
            return $this->transfer;
        }

    }
?>