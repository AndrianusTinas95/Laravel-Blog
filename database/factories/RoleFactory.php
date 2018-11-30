<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Role::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->unique()->jobTitle,
        'slug' => str_slug($name)
    ];
});
