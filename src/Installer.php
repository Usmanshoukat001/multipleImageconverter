<?php

namespace Usmanshoukat001\MultipleImageConverter;

class Installer
{
    public static function postInstall()
    {
        $appConfig = file_get_contents(config('app.php'));

        if (strpos($appConfig, 'Usmanshoukat001\\MultipleImageConverter\\Providers\\ConverterProvider::class') === false) {
            $appConfig = str_replace(
                "    'providers' => [",
                "    'providers' => [\n        Usmanshoukat001\\MultipleImageConverter\\Providers\\ConverterProvider::class,",
                $appConfig
            );
            file_put_contents(config('app.php'), $appConfig);
        }
    }

    public static function postUpdate()
    {
        $appConfig = file_get_contents(config('app.php'));

        if (strpos($appConfig, 'Usmanshoukat001\\MultipleImageConverter\\Providers\\ConverterProvider::class') !== false) {
            $appConfig = str_replace(
                "        Usmanshoukat001\\MultipleImageConverter\\Providers\\ConverterProvider::class,",
                '',
                $appConfig
            );
            file_put_contents(config('app.php'), $appConfig);
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
        $controllerPath =  app()->basePath('app/Http/Controllers/ImageController.php');
        if ($fileSystem->exists($controllerPath)) {
        if ($fileSystem->delete($controllerPath)) {
            echo "Controller file removed successfully.";
        } else {
            echo "Failed to remove the controller file.";
        }
    } else {
        echo "Controller file does not exist.";
    }
    }

    protected static function removeViewFile()
    {
        // Remove the view file
        $fileSystem = new Filesystem();
        $viewPath =  app()->basePath('resources/views/imageconverter.blade.php');
       if ($fileSystem->exists($viewPath)) {
        if ($fileSystem->delete($viewPath)) {
            echo "views file removed successfully.";
        } else {
            echo "Failed to remove the views file.";
        }
    } else {
        echo "views file does not exist.";
    }
    }
}
