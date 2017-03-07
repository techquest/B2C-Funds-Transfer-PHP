<?php
    namespace Interswitch\transfer;

    class Constants{
        const CURRENCY_CODE = "566";
        const INITATION_PAYMENT_METHOD_CODE = "CA";
        const TERMINATION_PAYMENT_METHOD_CODE="AC";
        const ACCOUNT_TYPE = "00";
        const TERMINAL_ID = "TerminalId";
        const GET = "GET";
        const POST = "POST";
        const TRANSFER_RESOURCE_URL = "api/v2/quickteller/payments/transfers";
        const MAX_TRANSFER_LENGTH = 12;
        const COUNTRY_CODE = "NG";
        const GET_ALL_BANKS_RESOURCE_URL = "api/v2/quickteller/configuration/fundstransferbanks";
        const ACCOUNT_VALIDATION_URL_PREFIX = "api/v1/nameenquiry/banks/";
        const ACCOUNT_VALIDATION_URL_SUFFIX = "accounts/";
    }
?>