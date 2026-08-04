<?php

namespace Alaaelsaid\LaravelSmsHelper\Implements;

use Alaaelsaid\LaravelSmsHelper\Contracts\SmsInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Taqnyat implements SmsInterface
{
    public function data($number, $message): array
    {
        $numbers = is_array($number) ? $number : explode(',', $number);

        $recipients = array_map(function ($num) {
            return preg_replace('/^(\+|00)/', '', trim($num));
        }, $numbers);

        return [
            'recipients' => array_values(array_filter($recipients)),
            'body'       => $message,
            'sender'     => config('sms.sms_sender_name'),
        ];
    }

    public function send($number, $message): array
    {
        $res = Http::baseUrl($this->url())
            ->acceptJson()
            ->withHeader('Authorization', config('sms.sms_password'))
            ->post('v1/messages', $this->data($number, $message))
            ->object();

        $statusCode = $res->statusCode ?? 500;
        $status = in_array((int) $statusCode, [200, 201]);
        $messageText = $res->message ?? ($status ? 'Message sent successfully' : 'Unknown Error');

        if (! $status) {
            Log::warning('Taqnyat SMS : '.$messageText);

            return ['code' => $statusCode, 'status' => false, 'message' => $messageText];
        }

        return ['code' => $statusCode, 'status' => true, 'message' => $messageText];
    }

    private function url(): string
    {
        return 'https://api.taqnyat.sa';
    }
}
