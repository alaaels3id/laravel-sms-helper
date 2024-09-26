<?php

namespace Alaaelsaid\LaravelSmsHelper\Facade;

use Alaaelsaid\LaravelSmsHelper\Contracts\SmsInterface;
use Illuminate\Support\Str;

class SmsProcessActions
{
    public function __construct(public SmsInterface $smsInterface) {}

    public function send($number, $message = ''): bool|array
    {
        $numbers = is_array($number) ? implode(',', $number) : MobilePhone::setCountryCode()->setPrefix($number);

        if ($this->canSend()) return $this->smsInterface->send($numbers, $message);

        else info($message);

        return false;
    }

    public function sendWithCode($number, $code = null): bool|array
    {
        $_code = ! is_null($code) ? $code : $this->code();

        return $this->send($number, $this->getMessage($_code));
    }

    public function code()
    {
        return config('sms.sms_code_dynamic') ? create_rand_numbers() : config('sms.sms_default_code');
    }

    public function getMessage($code): string
    {
        return Str::replaceArray('####', [$code], 'كود التفعيل الخاص بك هو : ####');
    }

    public function getForgetMessage($code): string
    {
        return Str::replaceArray('####', [$code], 'كود إعادة تعيين كلمة المرور هو : ####');
    }

    private function canSend(): bool
    {
        return config('sms.sms_provider_status');
    }
}