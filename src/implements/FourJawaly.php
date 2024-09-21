<?php

namespace Alaaelsaid\LaravelSmsHelper\implements;

use Alaaelsaid\LaravelSmsHelper\Contracts\SmsInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\{Http};

class FourJawaly implements SmsInterface
{
    public static string $api_key;

    public static string $app_secret;

    public static function data($number, $message): array
    {
        [$number_iso, $sender] = ['SA', config('sms.sms_sender_name')];

        $global = compact('number_iso', 'sender');

        $messages = [
            [
                'text'       => $message,
                'numbers'    => Arr::wrap($number),
                'number_iso' => $number_iso,
                'sender'     => $sender,
            ],
        ];

        return compact('messages', 'global');
    }

    public static function send($number, $message): array
    {
        $headers = ['Authorization' => 'Basic '.self::auth(), 'User-Agent' => 'Forejawali'];

        $res = Http::withHeaders($headers)->post(self::url(), self::data($number, $message))->object();

        if ($res->code !== 200)
        {
            return ['code' => $res->code, 'status' => false, 'message' => $res->message];
        }

        return ['code' => $res->code, 'status' => true, 'message' => $res->message];
    }

    private static function auth(): string
    {
        static::$api_key = config('sms.api_key');

        static::$app_secret = config('sms.secret_key');

        return base64_encode(static::$api_key.':'.static::$app_secret);
    }

    private static function url(): string
    {
        return 'https://api-sms.4jawaly.com/api/v1/account/area/sms/send';
    }
}
