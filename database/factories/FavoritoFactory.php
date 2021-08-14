<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Favorito;
use Faker\Generator as Faker;

$factory->define(Favorito::class, function (Faker $faker) {
    return [
        'user_id' => App\User::all()->random()->id,
        'anuncio_id' => App\Anuncio::all()->random()->id,
    ];
});
