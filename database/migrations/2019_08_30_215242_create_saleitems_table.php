<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saleitems', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('sale_id')->unsigned();

            $table->bigInteger('saleproduct_id')->unsigned();

            $table->decimal('precio', 8, 4);
            $table->decimal('descuento', 8, 4);
            $table->decimal('cantidad', 8, 4);
            //$table->timestamps();

            //Relationship
            $table->foreign('sale_id')->references('id')->on('sales')
              ->onDelete('cascade')
              ->onUpdate('cascade');

            $table->foreign('saleproduct_id')->references('id')->on('saleproducts')
              ->onDelete('cascade')
              ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saleitems');
    }
}
