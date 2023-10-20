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
     public static function postRemove()
    {
        // Remove specific files or directories
        self::removeControllerFile();
        self::removeViewFile();
    }

    protected static function removeControllerFile()
    {
        // Remove the controller file
        $fileSystem = new Filesystem();
        $controllerPath = app_path('Http/Controllers/ImageController.php');
        if ($fileSystem->exists($controllerPath)) {
            $fileSystem->delete($controllerPath);
        }
    }

    protected static function removeViewFile()
    {
        // Remove the view file
        $fileSystem = new Filesystem();
        $viewPath = resource_path('views/yourpackage/imageconverter.blade.php');
        if ($fileSystem->exists($viewPath)) {
            $fileSystem->delete($viewPath);
        }
    }
}
