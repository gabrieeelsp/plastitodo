<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sale;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'client_id' => rand(1,2),
        'user_id' => rand(1,2),
        'created_at' => $faker->datetime(),
        'status' => 'FINALIZADA',
    ];
});
