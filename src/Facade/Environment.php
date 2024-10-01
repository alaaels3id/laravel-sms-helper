  <?php

namespace Alaaelsaid\LaravelSmsHelper\Facade;

use Illuminate\Support\Env;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class Environment
{
    private static function updateEnv($key, $newValue, $delim, $is_bool): void
    {
        [$path, $oldValue] = [base_path('.env'), $is_bool ? (bool) Env::get($key) : Env::get($key)];

        if ($oldValue == ($newValue == 'true')) return;

        if (! file_exists($path)) return;

        $delim = str($oldValue)->contains('"') ? $delim : '';

        $_new = $is_bool ? $key . '=' . $newValue : $key . '=' . $delim . $newValue . $delim;

        $_old = $is_bool ? $key . '=' . ($oldValue ? 'true' : 'false') : $key . '=' . $delim . $oldValue . $delim;

        File::put($path, str(File::get($path))->replace($_old, $_new));

        Artisan::call('optimize:clear');
    }

    public static function update($key, $newValue, $delim = '"'): void
    {
        self::updateEnv($key, $newValue, $delim, false);
    }

    public static function updateBool($key, $newValue, $delim = ''): void
    {
        self::updateEnv($key, $newValue, $delim, true);
    }

    public static function updateBoolArray($arr): void
    {
        foreach ($arr as $key => $value)
        {
            self::updateBool($key, $value);
        }
    }
}
