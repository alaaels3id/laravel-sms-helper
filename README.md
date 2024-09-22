# This is some regex for PHP

## Installation

You can install the package via [Composer](https://getcomposer.org).

```bash
composer require alaaelsaid/laravel-sms-helper
```

## Publishing

After install publish file config

```bash
php artisan vendor:publish --tag="sms"
```

## Env
In the .env file you can add those keys:

## Available SMS Providers
Malath - Hisms - Four Jawaly - Unifonic - Yamamah

```dotenv
SMS_PROVIDER=four_jawaly
SMS_PROVIDER_STATUS=false
```

## Usage

```php
use Alaaelsaid\LaravelSmsHelper\Facade\Sms;

// to send single phone number;
Sms::send('+201007153686', "hello world");

// to send single phone number;
Sms::send(['+201007153686'], "hello world");