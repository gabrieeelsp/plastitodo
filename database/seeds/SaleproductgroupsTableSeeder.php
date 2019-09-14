<?php

use Illuminate\Database\Seeder;

class SaleproductgroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Saleproductgroup::create([
        'name' => 'Colorantes en Pasta FLEIBOR UNIDAD',
        'slug' => 'colorantes-en-pasta-fleibor-unidad'
      ]);

      App\Saleproductgroup::create([
        'name' => 'Colorantes en Pasta FLEIBOR PAQ x 4',
        'slug' => 'colorantes-en-pasta-fleibor-paq-x-4'
      ]);
    }
}
