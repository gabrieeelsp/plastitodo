<?php

use Illuminate\Database\Seeder;

class ProveedorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Proveedor::create([
        'name' => 'Movipack',
        'slug' => 'movipack',
        'direccion' => 'Zevallos 6568'
      ]);
    }
}
