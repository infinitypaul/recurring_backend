<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(2),
        'image' => 'https://picsum.photos/250/250?random'.rand(1, 9),
        'price' => $faker->numberBetween(1234, 9999999),
        'description' => $faker->sentence(10)
    ];
});
