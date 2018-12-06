<?php

use Faker\Generator as Faker;

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

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'username' => str_replace([' ', '.', ',', 'Mr', 'Ms'], '', $faker->unique()->name),
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'image' => 'default.png',
        'about' => $faker->paragraph(rand(1, 2)),
        'email_verified_at' => now(),
        'remember_token' => str_random(10),
    ];
});
