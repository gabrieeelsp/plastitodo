<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Saleitem;
use Faker\Generator as Faker;

$factory->define(Saleitem::class, function (Faker $faker) {
  return [
    'sale_id' => rand(1,51),
    'saleproduct_id' => rand(1,10),
    'precio' => 23.4635,
    'cantidad' => rand(1,20),
    'descuento' => 0

  ];
});
