<?php
    namespace Interswitch\utility;

    class Utility {
        public function __construct(){

        }
        static function generateMAC($request) {
            
            $in = $request->getInitiation();
            $tm = $request->getTermination();
            $init =($in->amount
            .$in->currencyCode
            .$in->paymentMethodCode
            .$tm->amount
            .$tm->currencyCode
            .$tm->paymentMethodCode
            .$tm->countryCode);
            echo $in->amount."\n";
            echo $in->currencyCode."\n";
            echo $in->paymentMethodCode."\n";
            echo $tm->amount."\n";
            echo $tm->currencyCode."\n";
            echo $tm->paymentMethodCode."\n";
            echo $tm->countryCode."\n";
            echo "mac meta-data ".$init."\n";

            
            $init = utf8_encode($init);

            $strhash = hash('sha512', $init);

            return $strhash;
        }
    }
?>