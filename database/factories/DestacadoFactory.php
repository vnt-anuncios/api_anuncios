<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Destacado;
use Faker\Generator as Faker;

$factory->define(Destacado::class, function (Faker $faker) {
    $date = $faker->date();
    $datefin= strtotime($date."+ 30 days");
    $datefin = date("Y-m-d",$datefin);
    return [
        'fechainicio' => $date,
        'fechafin' => $datefin,
        //'anuncio_id' => App\Anuncio::all()->random()->id,
        'anuncio_id' => $faker->unique()->numberBetween(1,150),
    ];
});
