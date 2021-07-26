<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Department;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    $faker->addProvider(new App\Faker\CustomFakerProvider($faker));
    return [
        'name' => $faker->word,
        'description' => $faker->text,
        'logo' => $faker->getFakeImage(
            storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'logo'),
            640, 480),
    ];
});
