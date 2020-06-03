<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
        'name' => 'Machuca Augusto',
        'email' => 'augusto_fer22@hotmail.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$k9xQj/8BU/cFJe53nFPcfuups5RhPorgikZiqUDl1KHx.L713o5Fy', // 36269830
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
