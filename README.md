https://banners.beyondco.de/Laravel%20SMS%20Helper.png?theme=light&packageManager=composer+require&packageName=alaaelsaid%2Flaravel-sms-helper&pattern=architect&style=style_1&description=This+package+integrates+with+saudi+arabia+sms+services&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg

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

## Command

You Can change sms current status with this command by [ on, off ] or get the current status

```bash
php artisan sms:current
php artisan sms:current off
```

## Env
In the .env file you can add those keys:

```dotenv
SMS_PROVIDER=four_jawaly
SMS_PROVIDER_STATUS=false
SMS_CODE_DYNAMIC=false
SMS_DEFAULT_CODE=1111
```

## Available SMS Providers
```
Malath - Hisms - Four Jawaly - Unifonic - Yamamah
```

## Usage

```php
use Alaaelsaid\LaravelSmsHelper\Facade\Sms;

// to send single phone number;
Sms::send('+201007153686', "hello world");

// to send multi phone numbers;
Sms::send(['+201007153686'], "hello world");

// to send single phone number && code is optional;
Sms::sendWithCode(['+201007153686'], '1111');
