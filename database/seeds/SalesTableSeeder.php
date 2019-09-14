<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Sale::create([
        'client_id' => '1',
        'user_id' => '1',
        'created_at' => Carbon::now()->toDateTimeString(),
        'status' => 'FINALIZADA',
      ]);

      factory(App\Sale::class, 50)->create();
    }
}
