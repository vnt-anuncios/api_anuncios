<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Favorito;
use Faker\Generator as Faker;

$factory->define(Favorito::class, function (Faker $faker) {
    $usuario_id = App\User::all()->random()->id;
    $anuncio_id = App\Anuncio::all()->random()->id;
    return [
        'user_id' => $usuario_id,
        'anuncio_id' => $anuncio_id,
    ];
});
