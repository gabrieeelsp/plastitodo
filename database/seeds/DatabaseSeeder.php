<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);

        $this->call(StockproductgroupsTableSeeder ::class);

        $this->call(SaleproductgroupsTableSeeder ::class);

        $this->call(RubrosTableSeeder ::class);
        $this->call(CategoriesTableSeeder ::class);

        $this->call(StockproductsTableSeeder ::class);

        $this->call(SaleproductsTableSeeder ::class);

        $this->call(ProveedorsTableSeeder ::class);

        $this->call(ClientsTableSeeder ::class);

        //$this->call(SalesTableSeeder ::class);

        //$this->call(SaleitemsTableSeeder ::class);
    }
}
