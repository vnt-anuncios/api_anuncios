<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Destacado;
use Faker\Generator as Faker;

$factory->define(Destacado::class, function (Faker $faker) {
    $dateInit = $faker->dateTimeBetween('-30 days', 'now + 5 days');
    $dateExpire = $faker->dateTimeBetween('now - 5 days', 'now + 20 days');
    $now = date("Y-m-d");

    $date1 = date_create($now);
    $date2 = date_create($dateExpire->format("Y-m-d"));
    $dif = date_diff($date1, $date2);
    $timeDiff = $dif->format("%R%a days");
    return [
        'fecha_inicio' => $dateInit,
        'fecha_fin' => $dateExpire,
        //'anuncio_id' => App\Anuncio::all()->random()->id,
        'estado' => ($timeDiff < 0) ? false : true,
        'anuncio_id' => $faker->unique()->numberBetween(1, 150),
    ];
});
