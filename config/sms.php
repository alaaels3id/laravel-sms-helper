<?php

return [
    'sms_number'          => '',
    'sms_password'        => '',
    'api_key'             => '',
    'secret_key'          => '',
    'sms_sender_name'     => '',
    'sms_provider'        => env('SMS_PROVIDER', 'malath'),
    'sms_provider_status' => env('SMS_PROVIDER_STATUS', 'false'),
    'sms_code_dynamic'    => env('SMS_CODE_DYNAMIC', 'false'),
    'sms_default_code'    => env('SMS_DEFAULT_CODE', '1111'),
];