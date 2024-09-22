<?php

namespace Alaaelsaid\LaravelSmsHelper\Contracts;

interface SmsInterface
{
    public function data($number, $message): array;

    public function send($number, $message): array;
}