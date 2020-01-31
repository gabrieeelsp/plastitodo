<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockproductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockproducts', function (Blueprint $table) {
          $table->bigIncrements('id');

          $table->bigInteger('category_id')->unsigned();

          $table->bigInteger('stockproductgroup_id')->nullable()->unsigned();

          $table->string('name', 128);
          $table->string('slug', 128)->unique();

          $table->decimal('costo', 8, 4)->default(0);
          $table->decimal('stock', 8, 2)->default(0);

          $table->decimal('iva', 4,2)->default(21);

          $table->decimal('stock_deposito', 8, 2)->default(0);

          //$table->timestamps();

          //Relationship
          $table->foreign('category_id')->references('id')->on('categories')
            ->onDelete('cascade')
            ->onUpdate('cascade');

          $table->foreign('stockproductgroup_id')->references('id')->on('stockproductgroups')
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
        Schema::dropIfExists('stockproducts');
    }
}
