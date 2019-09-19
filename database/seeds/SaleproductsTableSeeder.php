<?php

use Illuminate\Database\Seeder;

class SaleproductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Saleproduct::create([
        'name' => 'Bandejas Plasticas 101 WORK UNIDAD',
        'slug' => 'bandejas-plasticas-101-work-unidad',
        'stockproduct_id' => '1',
        'rel_venta_stock' => 1,
        'porc_min' => 40,
        'cant_may' => 100,
        'porc_may' => 15,
        'barcode' => '1234567891234',
      ]);

      App\Saleproduct::create([
        'name' => 'Bandejas Plasticas 102 WORK UNIDAD',
        'slug' => 'bandejas-plasticas-102-work-unidad',
        'stockproduct_id' => '2',
        'rel_venta_stock' => 1,
        'porc_min' => 40,
        'cant_may' => 100,
        'porc_may' => 15,
      ]);

      App\Saleproduct::create([
        'name' => 'Bandejas Plasticas 103 WORK UNIDAD',
        'slug' => 'bandejas-plasticas-103-work-unidad',
        'stockproduct_id' => '3',
        'rel_venta_stock' => 1,
        'porc_min' => 40,
        'cant_may' => 100,
        'porc_may' => 15,
      ]);

      App\Saleproduct::create([
        'name' => 'Bandejas Plasticas 105 WORK UNIDAD',
        'slug' => 'bandejas-plasticas-105-work-unidad',
        'stockproduct_id' => '4',
        'rel_venta_stock' => 1,
        'porc_min' => 40,
        'cant_may' => 100,
        'porc_may' => 15,
      ]);

      App\Saleproduct::create([
        'name' => 'Bandejas Plasticas 107 WORK UNIDAD',
        'slug' => 'bandejas-plasticas-107-work-unidad',
        'stockproduct_id' => '5',
        'rel_venta_stock' => 1,
        'porc_min' => 40,
        'cant_may' => 100,
        'porc_may' => 15,
      ]);

      App\Saleproduct::create([
        'name' => 'Colorante en Pasta ROJO FLEIBOR UNIDAD',
        'slug' => 'colorante-en-pasta-rojo-fleibor-unidad',
        'stockproduct_id' => '6',
        'rel_venta_stock' => 1,
        'porc_min' => 40,
        'cant_may' => 100,
        'porc_may' => 15,
      ]);

      App\Saleproduct::create([
        'name' => 'Colorante en Pasta ROJO FLEIBOR PAQ x 4',
        'slug' => 'colorante-en-pasta-rojo-fleibor-paq-x-4',
        'stockproduct_id' => '6',
        'rel_venta_stock' => 4,
        'porc_min' => 20,
        'cant_may' => 100,
        'porc_may' => 15,
      ]);

      App\Saleproduct::create([
        'name' => 'Colorante en Pasta AZUL FLEIBOR UNIDAD',
        'slug' => 'colorante-en-pasta-azul-fleibor-unidad',
        'stockproduct_id' => '7',
        'rel_venta_stock' => 1,
        'porc_min' => 40,
        'cant_may' => 100,
        'porc_may' => 15,
      ]);

      App\Saleproduct::create([
        'name' => 'Colorante en Pasta AZUL FLEIBOR PAQ x 4',
        'slug' => 'colorante-en-pasta-azul-fleibor-paq-x-4',
        'stockproduct_id' => '7',
        'rel_venta_stock' => 4,
        'porc_min' => 20,
        'cant_may' => 100,
        'porc_may' => 15,
      ]);

      App\Saleproduct::create([
        'name' => 'Colorante en Pasta VERDE FLEIBOR UNIDAD',
        'slug' => 'colorante-en-pasta-verde-fleibor-unidad',
        'stockproduct_id' => '8',
        'rel_venta_stock' => 1,
        'porc_min' => 40,
        'cant_may' => 100,
        'porc_may' => 15,
      ]);

      App\Saleproduct::create([
        'name' => 'Colorante en Pasta VERDE FLEIBOR PAQ x 4',
        'slug' => 'colorante-en-pasta-verde-fleibor-paq-x-4',
        'stockproduct_id' => '8',
        'rel_venta_stock' => 4,
        'porc_min' => 20,
        'cant_may' => 100,
        'porc_may' => 15,
      ]);
    }
}
