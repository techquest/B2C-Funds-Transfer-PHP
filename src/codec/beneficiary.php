<?php
    namespace Interswitch\codec;

    class Beneficiary{

        public $phone;
        public $email;
        public $lastname;
        public $othernames;

        public function __construct($phone, $email, $lastname, $othernames) {
            //empty
            $this->phone = $phone;
            $this->email = $email;
            $this->lastname = $lastname;
            $this->othernames = $othernames;
        }

        
    }
?>