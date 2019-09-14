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
    }
}
