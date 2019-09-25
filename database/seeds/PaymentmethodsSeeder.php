<?php

use Illuminate\Database\Seeder;

class PaymentmethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Paymentmethod::create([
        'name' => 'EFECTIVO',
        'slug' => 'efectivo',
        'recargo' => 0
      ]);

      App\Paymentmethod::create([
        'name' => 'VISA Débito',
        'slug' => 'visa-debito',
        'recargo' => 0
      ]);

      App\Paymentmethod::create([
        'name' => 'VISA Crédito 1 CUOTAS',
        'slug' => 'visa-credito-1-cuotas',
        'recargo' => 5
      ]);

      App\Paymentmethod::create([
        'name' => 'VISA Crédito 3 CUOTAS',
        'slug' => 'visa-credito-3-cuotas',
        'recargo' => 20
      ]);


    }
}
