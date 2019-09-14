<?php

use Illuminate\Database\Seeder;

class RubrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Rubro::create([
        'name' => 'Descartables',
        'slug' => 'descartables'
      ]);

      App\Rubro::create([
        'name' => 'Reposteria',
        'slug' => 'reposteria'
      ]);
    }
}
