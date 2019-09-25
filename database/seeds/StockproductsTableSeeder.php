<?php

use Illuminate\Database\Seeder;

class StockproductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Stockproduct::create([
        'name' => 'Bandejas Plasticas 101 WORK UNIDAD',
        'slug' => 'bandejas-plasticas-101-work-unidad',
        'category_id' => '1',
        'costo' => 10,
        'stock' => 100
      ]);

      App\Stockproduct::create([
        'name' => 'Bandejas Plasticas 102 WORK UNIDAD',
        'slug' => 'bandejas-plasticas-102-work-unidad',
        'category_id' => '1',
        'costo' => 10,
        'stock' => 100
      ]);

      App\Stockproduct::create([
        'name' => 'Bandejas Plasticas 103 WORK UNIDAD',
        'slug' => 'bandejas-plasticas-103-work-unidad',
        'category_id' => '1',
        'costo' => 10,
        'stock' => 100
      ]);

      App\Stockproduct::create([
        'name' => 'Bandejas Plasticas 105 WORK UNIDAD',
        'slug' => 'bandejas-plasticas-105-work-unidad',
        'category_id' => '1',
        'costo' => 10,
        'stock' => 100
      ]);

      App\Stockproduct::create([
        'name' => 'Bandejas Plasticas 107 WORK UNIDAD',
        'slug' => 'bandejas-plasticas-107-work-unidad',
        'category_id' => '1',
        'costo' => 10,
        'stock' => 100
      ]);

      App\Stockproduct::create([
        'name' => 'Colorante en Pasta ROJO FLEIBOR UNIDAD',
        'slug' => 'colorante-en-pasta-rojo-fleibor-unidad',
        'category_id' => '2',
        'costo' => 35,
        'stock' => 100
      ]);

      App\Stockproduct::create([
        'name' => 'Colorante en Pasta AZUL FLEIBOR UNIDAD',
        'slug' => 'colorante-en-pasta-azul-fleibor-unidad',
        'category_id' => '2',
        'costo' => 35,
        'stock' => 100
      ]);

      App\Stockproduct::create([
        'name' => 'Colorante en Pasta VERDE FLEIBOR UNIDAD',
        'slug' => 'colorante-en-pasta-verde-fleibor-unidad',
        'category_id' => '2',
        'costo' => 35,
        'stock' => 100
      ]);

      App\Stockproduct::create([
        'name' => 'Dulce de Leche EUREKA 10,00Kg UNIDAD',
        'slug' => 'dulce-de-leche-eureka-10-00kg-unidad',
        'category_id' => '3',
        'costo' => 830,
        'stock' => 20
      ]);

      App\Stockproduct::create([
        'name' => 'Bolsa de Polipropileno 10x15 UNIDAD',
        'slug' => 'bolsa-de-polipropileno-10x15-unidad',
        'category_id' => '4',
        'costo' => 0.15,
        'stock' => 20000
      ]);
    }
}
