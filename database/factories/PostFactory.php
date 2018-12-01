<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post::class, function (Faker $faker) {
    return [
        'author' => rand(1, 2),
        'title' => $title = $faker->unique()->text(50),
        'slug' => str_slug($title),
        'image' => 'default.png',
        'body' => $faker->paragraph(rand(1, 3)),
        'view' => rand(0, 100),
        'status' => $status = rand(0, 1),
        'is_approved' => $status,
    ];
});
