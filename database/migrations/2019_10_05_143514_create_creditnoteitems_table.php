<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditnoteitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditnoteitems', function (Blueprint $table) {
          $table->bigIncrements('id');

          $table->bigInteger('creditnote_id')->unsigned();

          $table->bigInteger('saleproduct_id')->unsigned();

          $table->decimal('precio', 8, 4);
          $table->decimal('descuento', 8, 4);
          $table->decimal('cantidad', 8, 4);
          $table->boolean('retornar_stock')->default(true);
          //$table->timestamps();

          //Relationship
          $table->foreign('creditnote_id')->references('id')->on('creditnotes')
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
        Schema::dropIfExists('creditnoteitems');
    }
}
