<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Agente;
use Faker\Generator as Faker;

$factory->define(Agente::class, function (Faker $faker) {
    return [
        'cuil' => $faker->unique()->numberBetween($min = 20000000000, $max = 27000000000),
        'nombre' => $faker->name,
        'fecha_nac' => now(),
        'sexo' => $faker->randomElement(['male', 'female'])
    ];
});
