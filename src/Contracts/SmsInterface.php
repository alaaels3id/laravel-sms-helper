<?php

namespace Alaaelsaid\LaravelSmsHelper\Contracts;

interface SmsInterface
{
    public static function data($number, $message): array;

    public static function send($number, $message): array;
}