<?php

return [
    'sms_number'          => '',
    'sms_password'        => '',
    'api_key'             => '',
    'secret_key'          => '',
    'sms_sender_name'     => '',
    'sms_provider'        => env('SMS_PROVIDER', 'malath'),
    'sms_provider_status' => env('SMS_PROVIDER_STATUS', 'false'),
];