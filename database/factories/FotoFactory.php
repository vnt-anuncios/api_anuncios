<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Foto;
use Faker\Generator as Faker;
use Faker\Factory as Fake;

$factory->define(Foto::class, function (Faker $faker) {
    $fak = Fake::create();
    $fak->addProvider(new Bluemmb\Faker\PicsumPhotosProvider($faker));
    return [
        'enlace' => $fak->imageUrl(640, 480, true),
        'anuncio_id' => App\Anuncio::all()->random()->id,
    ];
});
