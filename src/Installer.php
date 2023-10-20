<?php

namespace Usmanshoukat001\MultipleImageConverter;

class Installer
{
    public static function postInstall()
    {
        $appConfig = file_get_contents(config_path('app.php'));

        if (strpos($appConfig, 'Usmanshoukat001\\MultipleImageConverter\\Providers\\ConverterProvider::class') === false) {
            $appConfig = str_replace(
                "    'providers' => [",
                "    'providers' => [\n        Usmanshoukat001\\MultipleImageConverter\\Providers\\ConverterProvider::class,",
                $appConfig
            );
            file_put_contents(config_path('app.php'), $appConfig);
        }
    }

    public static function postUpdate()
    {
        $appConfig = file_get_contents(config_path('app.php'));

        if (strpos($appConfig, 'Usmanshoukat001\\MultipleImageConverter\\Providers\\ConverterProvider::class') !== false) {
            $appConfig = str_replace(
                "        Usmanshoukat001\\MultipleImageConverter\\Providers\\ConverterProvider::class,",
                '',
                $appConfig
            );
            file_put_contents(config_path('app.php'), $appConfig);
        }
    }
}
