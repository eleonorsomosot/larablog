<?php

use Faker\Generator as Faker;

$factory->define(App\Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(7, true),
        'body' => $faker->realText(200, 5),
        'author_id' => $faker->numberBetween(1, 3)
    ];
});
