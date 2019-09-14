<?php

use Illuminate\Database\Seeder;

class SaleitemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Saleitem::create([
        'sale_id' => rand(1, 50),
        'saleproduct_id' => 1,
        'precio' => 23.8,
        'cantidad' => 10,
        'descuento' => 0,
      ]);

      factory(App\Saleitem::class, 500)->create();
    }
}
