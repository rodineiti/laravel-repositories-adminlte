<?php

namespace App\Support;

class Cropper
{
    public static function thumb(string $uri, int $width, int $height = null)
    {
        $cropper = new \CoffeeCode\Cropper\Cropper(public_path('uploads/cache'));
        $pathThumb = $cropper->make(config('filesystems.disks.public_uploads.root') . '/' . $uri, $width, $height);

        $file = 'cache/' . collect(explode('/', $pathThumb))->last();
        return $file;
    }

    public static function flush(?string $path)
    {
        $cropper = new \CoffeeCode\Cropper\Cropper(public_path('uploads/cache'));

        if (!$path) {
            $cropper->flush($path);
        } else {
            $cropper->flush();
        }
    }
}