<?php

namespace App\Faker;

use Faker\Provider\Image;
use File;

class CustomFakerProvider extends Image
{
    public function getFakeImage(string $path, int $w, int $h, $cat = null, $fullPath = false): string
    {
        sleep(1);
        $fileName = $this->image($path, $w, $h, $cat, $fullPath);
        if(!$fileName) {
            $fileName = $this->getFakeImage($path, $w, $h, $cat, $fullPath);
        }

        if($this->getImageSize($path, $fileName) === 0) {
            File::delete($path . DIRECTORY_SEPARATOR . $fileName);
            $this->getFakeImage($path, $w, $h, $cat, $fullPath);
        }

        return $fileName;
    }

    public function getImageSize($path, $fileName): int
    {
        return File::size($path . DIRECTORY_SEPARATOR . $fileName);
    }
}