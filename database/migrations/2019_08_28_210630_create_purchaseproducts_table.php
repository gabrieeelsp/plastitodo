<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseproducts', function (Blueprint $table) {
          $table->bigIncrements('id');

          $table->bigInteger('stockproduct_id')->unsigned();

          $table->bigInteger('proveedor_id')->unsigned();

          $table->string('name', 128);
          $table->string('slug', 128)->unique();

          $table->decimal('rel_stock_compra', 8, 4)->default(1);

          $table->decimal('porc_min', 8, 4)->default(40);

          $table->decimal('cant_may', 8, 2)->default(1);

          $table->decimal('porc_may', 8, 4)->default(15);


          //$table->timestamps();

          //Relationship
          $table->foreign('stockproduct_id')->references('id')->on('stockproducts')
            ->onDelete('cascade')
            ->onUpdate('cascade');

          $table->foreign('proveedor_id')->references('id')->on('proveedors')
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
        Schema::dropIfExists('purchaseproducts');
    }
}
