<?php

namespace Alaaelsaid\LaravelSmsHelper\implements;

use Alaaelsaid\LaravelSmsHelper\Contracts\SmsInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\{Http};

class FourJawaly implements SmsInterface
{
    public string $api_key;

    public string $app_secret;

    public function __construct()
    {
        $this->api_key = config('sms.api_key');

        $this->app_secret = config('sms.secret_key');
    }

    public function data($number, $message): array
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

    public function send($number, $message): array
    {
        $headers = ['Authorization' => 'Basic '.self::auth(), 'User-Agent' => 'Forejawali'];

        $res = Http::withHeaders($headers)->post(self::url(), self::data($number, $message))->object();

        if ($res->code !== 200)
        {
            return $this->response($res->code, false, $res->message);
        }

        return $this->response($res->code, true, $res->message);
    }

    private function auth(): string
    {
        return base64_encode($this->api_key.':'.$this->app_secret);
    }

    private function url(): string
    {
        return 'https://api-sms.4jawaly.com/api/v1/account/area/sms/send';
    }

    private function response($code, $status, $message): array
    {
        return ['code' => $code, 'status' => $status, 'message' => $message];
    }
}
