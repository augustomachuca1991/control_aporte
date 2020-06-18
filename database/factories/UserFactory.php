<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'rambo',
        'email' => 'aa_dy@hotmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make('123456789'), // 123456789
        'remember_token' => Str::random(10),
    ];

    //return [
    //    'name' => $faker->name,
    //    'apellido' => $faker->name,
    //    'email' => $faker->unique()->safeEmail,
    //    'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
    //    'remember_token' => Str::random(60),
    //];
});
