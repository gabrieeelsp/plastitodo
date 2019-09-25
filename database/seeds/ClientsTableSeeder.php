<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Client::create([
        'name' => 'Roberto Pereyra',
        'slug' => 'roberto-pereyra',
        'tipo' => 'Minorista',
        'saldo' => 0
      ]);

      App\Client::create([
        'name' => 'Ivan Issadora',
        'slug' => 'ivan-issadora',
        'tipo' => 'Mayorista',
        'saldo' => 0
      ]);
    }
}
