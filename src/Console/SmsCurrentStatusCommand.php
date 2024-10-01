<?php

namespace Alaaelsaid\LaravelSmsHelper\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Alaaelsaid\LaravelSmsHelper\Facade\Environment;

class SmsCurrentStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:current {value?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Current SMS Provider name Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if($this->hasArgument('value'))
        {
            $value = strtolower($this->argument('value'));

            if (! in_array($value, ['on', 'off']))
            {
                $this->components->error('The value must be ON or OFF');

                return;
            }

            $new_value = ($value == 'on') ? 'true' : 'false';

            Environment::updateBool('SMS_PROVIDER_STATUS', $new_value);

            $this->components->info('SMS Current status is : ' . $value);

            return;
        }

        $current_status = config('sms.sms_provider_status') ? 'ON' : 'OFF';

        $this->components->info('Current status is : '.$current_status);
    }
}
