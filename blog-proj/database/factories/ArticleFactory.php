<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'body' => $faker->text(191),
        'url' => $faker->text(25),
        'likes' => $faker->text(5)
    ];
});
