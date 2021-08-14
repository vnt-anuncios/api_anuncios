<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Foto;
use Faker\Generator as Faker;

$factory->define(Foto::class, function (Faker $faker) {
    return [
        'enlace' => $faker->imageUrl(),
        'anuncio_id' => App\Anuncio::all()->random()->id,
    ];
});
