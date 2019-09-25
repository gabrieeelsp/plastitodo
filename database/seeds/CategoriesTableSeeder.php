<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Category::create([
        'name' => 'Bandejas Plasticas WORK',
        'slug' => 'bandejas-plasticas-work',
        'rubro_id' => '1'
      ]);

      App\Category::create([
        'name' => 'Colorantes en Pasta FLEIBOR',
        'slug' => 'colorantes-en-pasta-fleibor',
        'rubro_id' => '2'
      ]);

      App\Category::create([
        'name' => 'Dulce de Leche EUREKA',
        'slug' => 'dulce-de-leche-eureka',
        'rubro_id' => '2'
      ]);
      App\Category::create([
        'name' => 'Bolsa de Polipropileno',
        'slug' => 'bolsa-de-polipropileno',
        'rubro_id' => '1'
      ]);
    }
}
