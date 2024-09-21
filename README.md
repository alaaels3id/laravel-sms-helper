# This is some regex for PHP

## Installation

You can install the package via [Composer](https://getcomposer.org).

```bash
composer require alaaelsaid/laravel-sms-helper
```

## Usage

```php
use Alaaelsaid\LaravelSmsHelper\Facade\Sms;

// to send single phone number;
Sms::send('+201007153686', "hello world");

// to send single phone number;
Sms::send(['+201007153686'], "hello world");