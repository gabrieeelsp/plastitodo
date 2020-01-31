<?php

use Illuminate\Database\Seeder;

class DocumentgroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Documentgroup::create([
        'name' => 'A',

      ]);

      App\Documentgroup::create([
        'name' => 'B',

      ]);

      App\Documentgroup::create([
        'name' => 'TZ',

      ]);
    }
}
