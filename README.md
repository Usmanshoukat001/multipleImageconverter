
# Multiple Image Converter for Laravel

The **Multiple Image Converter** is a Laravel package that provides support for converting images between various formats. This package leverages popular PHP libraries such as Guzzle, Intervention Image, ImageMagick, and Laravel FFMpeg to offer a comprehensive solution for image conversion.

## Table of Contents

- [Installation](#installation)
- [Requirements](#requirements)
- [Usage](#usage)
- [Configuration](#configuration)
- [Example Routes](#example-routes)
- [License](#license)

## Installation

You can install the package via Composer by running the following command:

```shell
composer require usmanshoukat001/multiple_image_converter
```

After installation, you can publish the package's configuration files with the following command:

```shell
php artisan laravel-converter:publish
```

This will allow you to customize the package's configuration to fit your project's needs.

## Requirements

To use the **Multiple Image Converter**, you will need to have the following dependencies installed:

- [Guzzle HTTP](https://github.com/guzzle/guzzle): "^7.0.1"
- [Intervention Image](http://image.intervention.io/): "^2.7"
- [ImageMagick-PHP](https://github.com/contao/imagemagick-php): "^3.3"
- [Laravel FFMpeg](https://github.com/pascalbaljetmedia/laravel-ffmpeg): "^8.3"

Make sure these packages are properly set up in your Laravel project.

## Usage

The package offers a simple way to convert images. To get started, follow these steps:

1. Add the conversion routes to your `web.php` file:

```php
Route::get('image/converter', function () {
    return view('imageconverter');
})->name('imageconverter');

Route::post('image/converter', ['App\Http\Controllers\ImageController', 'imageconverter'])->name('image.converter');
```

2. Create a view named 'imageconverter' to allow users to upload images for conversion.

3. Implement the 'imageconverter' method in your `ImageController` to handle the image conversion based on your project's requirements.

## Configuration

You can customize the package's configuration by editing the `config/multiple_image_converter.php` file. This file allows you to specify settings such as image format options and conversion parameters.

## Example Routes

Here are two example routes you can use as a starting point:

- `GET /image/converter`: Displays a view for image conversion.
- `POST /image/converter`: Handles the image conversion process.

You can modify these routes to fit your project's structure and requirements.

## License

This package is open-source software licensed under the [MIT license](LICENSE).

---

Feel free to add more details and specific usage instructions based on the functionalities of your package. Additionally, consider providing code examples and other documentation as needed for users to understand how to utilize the package effectively.
