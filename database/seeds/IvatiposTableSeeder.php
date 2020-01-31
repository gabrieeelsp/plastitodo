<?php

use Illuminate\Database\Seeder;

class IvatiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Ivatipo::create([
        'name' => 'IVA Responsable Inscripto',
        'codigo_afip' => '1',
      ]);
      App\Ivatipo::find(1)->documentgroups()->attach(1);


      App\Ivatipo::create([
        'name' => 'IVA Sujeto Exento',
        'codigo_afip' => '4',
      ]);
      App\Ivatipo::find(2)->documentgroups()->attach(2);

      App\Ivatipo::create([
        'name' => 'Consumidor Final',
        'codigo_afip' => '5',
      ]);

      App\Ivatipo::find(3)->documentgroups()->attach(2);
      App\Ivatipo::find(3)->documentgroups()->attach(3);

      App\Ivatipo::create([
        'name' => 'Responsable Monotributo',
        'codigo_afip' => '6',
      ]);

      App\Ivatipo::find(4)->documentgroups()->attach(2);
      App\Ivatipo::find(4)->documentgroups()->attach(3);
    }
}
