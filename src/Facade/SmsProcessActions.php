<?php

namespace Alaaelsaid\LaravelSmsHelper\Facade;

use Alaaelsaid\LaravelSmsHelper\Contracts\SmsInterface;
use Illuminate\Support\Str;

class SmsProcessActions
{
    public SmsInterface $smsInterface;

    public function __construct(SmsInterface $smsInterface)
    {
        $this->smsInterface = $smsInterface;
    }

    public function send($number, $message = ''): bool|array
    {
        $numbers = is_array($number) ? implode(',', $number) : MobilePhone::setCountryCode()->setPrefix($number);

        if (self::canSend()) return $this->smsInterface->send($numbers, $message);

        else info($message);

        return false;
    }

    public function sendWithCode($number, $code = null): bool|array
    {
        $_code = ! is_null($code) ? $code : self::code();

        return self::send($number, self::getMessage($_code));
    }

    public static function code()
    {
        return config('sms.sms_code_dynamic') ? create_rand_numbers() : config('sms.sms_default_code');
    }

    public static function getMessage($code): string
    {
        return Str::replaceArray('####', [$code], 'كود التفعيل الخاص بك هو : ####');
    }

    public static function getForgetMessage($code): string
    {
        return Str::replaceArray('####', [$code], 'كود إعادة تعيين كلمة المرور هو : ####');
    }

    private static function canSend(): bool
    {
        return config('sms.sms_provider_status');
    }
}