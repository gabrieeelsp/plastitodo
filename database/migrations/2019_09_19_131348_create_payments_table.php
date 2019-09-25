<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('paymentmethod_id')->unsigned();
            $table->bigInteger('client_id')->unsigned()->nullable();
            $table->bigInteger('sale_id')->unsigned()->nullable();

            $table->decimal('valor', 10, 4)->default(0);

            $table->enum('status', ['EDITANDO', 'CONFIRMADO']);

            $table->decimal('recargo', 10, 4)->default(0);

            $table->decimal('saldo', 10, 4)->default(0);

            $table->dateTime('created_at');

            //$table->timestamps();

            //Relationship
            $table->foreign('paymentmethod_id')->references('id')->on('paymentmethods')
              ->onDelete('cascade')
              ->onUpdate('cascade');

            $table->foreign('client_id')->references('id')->on('clients')
              ->onDelete('cascade')
              ->onUpdate('cascade');

            $table->foreign('sale_id')->references('id')->on('sales')
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
        Schema::dropIfExists('payments');
    }
}
