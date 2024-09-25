<?php

namespace Alaaelsaid\LaravelSmsHelper\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * @method static send(string|array $number, string $message)
 * @method static sendWithCode(string|array $number, $code = null)
 *
 * @see SmsProcessActions
 */
class Sms extends Facade
{
    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'Sms';
    }
}