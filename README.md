# This is some regex for PHP

## Installation

You can install the package via [Composer](https://getcomposer.org).

```bash
composer require alaaelsaid/laravel-regexs
```

## Usage

```php
use Alaaelsaid\LaravelRegexs\Facade\Regex;

$is_valid_email = Regex::email('example@email.com'); // return TRUE;

$is_valid_youtube_url = Regex::youtube('example@email.com'); // return FALSE

$is_valid_english_sentence = Regex::english('مرحبا'); // return FALSE

$is_valid_arabic_sentence = Regex::arabic('Hello'); // return FALSE

$is_valid_country_code = Regex::countryCode('966'); // return TRUE

$is_valid_url = Regex::url('link.here-com'); // return FALSE
