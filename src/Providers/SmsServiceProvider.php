<?php

namespace Alaaelsaid\LaravelSmsHelper\Providers;

use Alaaelsaid\LaravelSmsHelper\Contracts\SmsInterface;
use Alaaelsaid\LaravelSmsHelper\Facade\SmsProcessActions;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/sms.php' => config_path('sms.php'),
        ],'sms');
    }

    public function register(): void
    {
        $name = config('sms.sms_provider');

        $this->app->bind(SmsInterface::class,'Alaaelsaid\LaravelSmsHelper\implements\\'.str($name)->camel()->ucfirst());

        $this->app->singleton('Sms', function() {
            return new SmsProcessActions(app(SmsInterface::class));
        });

        $this->mergeConfigFrom(
            __DIR__.'/../config/sms.php', 'sms'
        );

        $this->app->register(self::class);
    }
}