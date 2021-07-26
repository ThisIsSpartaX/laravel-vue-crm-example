<?php

namespace App\Factories;

use Faker\Generator;

class CustomFakerGenerator extends Generator
{
    public function getFakeImage(string $path, int $w, int $h, $cat = null, $fullPath = false): string
    {
        //Waiting for previous downloading and create image
        sleep(1);

        $image = $this->faker->image($path, $w, $h, $cat, $fullPath);

        //Try again if image not downloaded
        if(!$image) {
            $image = $this->getFakeImage($path, $w, $h, $cat, $fullPath);
        }

        return $image;
    }
}