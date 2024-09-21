<?php

namespace Alaaelsaid\LaravelSmsHelper\Facade;

use Illuminate\Support\Facades\Facade;

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