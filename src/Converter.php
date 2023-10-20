<?php

namespace Usmanshoukat001\MultipleImageConverter;

class Converter
{
    public function image_convert($data)
    {
        $image = $data->file;
        $option = $data->option;
        $originalFileName = $image->getClientOriginalName();
        $disk = \Storage::disk("local");
        $disk->put("public/" . $originalFileName,file_get_contents($image));
        $imagePath = storage_path('app/public/' . $originalFileName);
        $tempImagePath = storage_path('app/public/' . uniqid() . '-' . pathinfo($originalFileName, PATHINFO_FILENAME) . '.' . $option);

        try {
            if ($option == 'ogg' || $option == 'odd') {
                $ffmpegPath = config('app.FFMpegPath');
                $ffmpegCommand = "$ffmpegPath -loop 1 -framerate 1 -i \"$imagePath\" -t 10 -c:a libvorbis -q:a 3 \"$tempImagePath\" 2>&1";
                $descriptors = [
                    0 => ["pipe", "r"],
                    1 => ["pipe", "w"],
                    2 => ["pipe", "w"],
                ];
                $process = proc_open($ffmpegCommand, $descriptors, $pipes);
                if (is_resource($process)) {
                    proc_close($process);
                }
            } else {
                $imagick = new \Imagick($imagePath);

                if (pathinfo($imagePath, PATHINFO_EXTENSION) == 'png') {
                    $imagick->setImageBackgroundColor(new \ImagickPixel('white'));
                    $imagick = $imagick->flattenImages();
                }

                $imagick->setImageFormat($option);
                $imagick->writeImage($tempImagePath);
                $imagick->clear();
                $imagick->destroy();
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }

        return [
            'message' => 'Image converted successfully',
            'converted_image_name' => pathinfo($tempImagePath, PATHINFO_BASENAME),
        ];
    }
}
