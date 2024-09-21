<?php

namespace Alaaelsaid\LaravelSmsHelper\Providers;

use Alaaelsaid\LaravelSmsHelper\Contracts\SmsInterface;
use Alaaelsaid\LaravelSmsHelper\Facade\SmsProcessActions;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Package;

class SmsServiceProvider extends PackageServiceProvider
{
    public function register(): void
    {
        $name = config('sms.sms_provider');

        $this->app->bind(SmsInterface::class,'Alaaelsaid\LaravelSmsHelper\implements\\'.str($name)->camel()->ucfirst());

        $this->app->singleton('Sms', fn(SmsInterface $sms) => new SmsProcessActions($sms));
    }

    public function configurePackage(Package $package): void
    {
        $package->name('laravel-sms-helper')
            ->hasConfigFile('sms');
    }
}