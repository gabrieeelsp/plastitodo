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
    }
}
