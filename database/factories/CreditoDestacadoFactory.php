<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CreditoDestacado;
use Faker\Generator as Faker;

$factory->define(CreditoDestacado::class, function (Faker $faker) {
    return [
        'cantidad' => $faker->numberBetween(1,10),
        'categoria_id' => App\Categoria::where('categoria_id',null)->get()->random()->id,
    ];
});
