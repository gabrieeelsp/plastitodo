<?php

use Illuminate\Database\Seeder;

class StockproductgroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Stockproductgroup::create([
        'name' => 'Colorantes en Pasta FLEIBOR',
        'slug' => 'colorantes-en-pasta-fleibor'
      ]);
    }
}
