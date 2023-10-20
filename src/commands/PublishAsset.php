<?php
namespace Usmanshoukat001\MultipleImageConverter\commands;

use Illuminate\Console\Command;

class PublishAsset extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'laravel-converter:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Asset in application.';

    public $composer;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->composer = app()['composer'];
    }

    public function handle()
    {
        $controllerDir = app()->basePath('app/Http/Controllers');
        $ControllerTemplate = file_get_contents(__DIR__.'/stubs/ImageController.stub');
        $this->createFile($controllerDir . DIRECTORY_SEPARATOR, 'ImageController.php', $ControllerTemplate);
        $this->info('ImageController.php file is published.');

        $viewDir = app()->basePath('resources/views');
        $HtmlTemplate = file_get_contents(__DIR__.'/stubs/imageconverter.blade.stub');
        $this->createFile($viewDir . DIRECTORY_SEPARATOR, 'imageconverter.blade.php', $HtmlTemplate);
        $this->info('imageconverter.blade.php file is published.');


        $this->info('Generating autoload files');
        $this->composer->dumpOptimized();

        $this->info('Greeting!.. Enjoy Image Converter...');
    }

    public static function createFile($path, $fileName, $contents)
    {
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $path = $path . $fileName;

        file_put_contents($path, $contents);
    }
}
