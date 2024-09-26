<?php

namespace Alaaelsaid\LaravelSmsHelper\Implements;

use Alaaelsaid\LaravelSmsHelper\Contracts\SmsInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Jawal implements SmsInterface
{
    public static function messages($code): string
    {
        return match ($code) {
            0       => 'Message send successfully',
            101     => 'Parameter are missing',
            104     => 'Either user name or password are missing or your Account is on hold.',
            105     => 'Credit are not available.',
            106     => 'Wrong Unicode.',
            107     => 'Blocked Sender Name.',
            108     => 'Missing Sender name.',
            1010    => 'SMS Text Grater that 6 part .',
            default => 'Unknown Error !.',
        };
    }

    public static function errors(): array
    {
        return [101, 104, 105, 106, 107, 108, 1010];
    }

    public function data($number, $message): array
    {
        return [
            'username' => config('sms.sms_number'),
            'password' => config('sms.sms_password'),
            'unicode'  => 'E',
            'mobile'   => $number,
            'message'  => $message,
            'sender'   => config('sms.sms_sender_name'),
        ];
    }

    public function send($number, $message): array
    {
        $result = Http::post('https://www.jawalsms.net/httpSmsProvider.aspx', self::data($number, $message))->object();

        $code = $result->code;

        if (in_array($code, self::errors())) {
            Log::warning('jawal Sms : ' . $result['message']);
        }

        return ['code' => $code, 'message' => self::messages($code)];
    }
}
