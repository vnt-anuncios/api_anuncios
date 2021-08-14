<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Anuncio;
use Faker\Generator as Faker;

$factory->define(Anuncio::class, function (Faker $faker) {
    $est = ['nuevo','medio uso','usadango'];
    return [
        
        'titulo' => $faker->title,
        'precio' => $faker->randomFloat(2,2,999),
        'fecha_publicacion'=>$faker->dateTimeBetween('now','+30 years'),
        'condicion_encuentra' => $faker->randomElement($est),
        'ubicacion'=> $faker->address,
        'enlace' => $faker->unique()->url,
        'descripcion' => $faker->text(500),
        'user_id' => App\User::all()->random()->id,
        'categoria_id' => App\Categoria::all()->random()->id,

    ];
});
