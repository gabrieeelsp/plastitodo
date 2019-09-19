<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saleproducts', function (Blueprint $table) {
          $table->bigIncrements('id');

          $table->bigInteger('stockproduct_id')->unsigned();

          $table->bigInteger('saleproductgroup_id')->nullable()->unsigned();

          $table->string('name', 128);
          $table->string('slug', 128)->unique();

          $table->string('barcode')->nullable();

          $table->decimal('rel_venta_stock', 8, 4)->default(1);

          $table->decimal('porc_min', 8, 4)->default(40);

          $table->decimal('cant_may', 8, 2)->default(1);

          $table->decimal('porc_may', 8, 4)->default(15);


          //$table->timestamps();

          //Relationship
          $table->foreign('stockproduct_id')->references('id')->on('stockproducts')
            ->onDelete('cascade')
            ->onUpdate('cascade');

          $table->foreign('saleproductgroup_id')->references('id')->on('saleproductgroups')
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
        Schema::dropIfExists('saleproducts');
    }
}
