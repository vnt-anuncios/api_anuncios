<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Banner;
use Faker\Generator as Faker;

$factory->define(Banner::class, function (Faker $faker) {
    $date = $faker->date();
    $datefin= strtotime($date."+ 10 days");
    $datefin = date("Y-m-d",$datefin);
    return [
        'enlace' => $faker->imageUrl(),
        'fechainicio' => $date,
        'fechafin' => $datefin,
        'anuncio_id' => $faker->unique()->numberBetween(1,150),
    ];
});
