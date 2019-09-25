<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('client_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned();

            $table->dateTime('created_at');

            $table->decimal('total', 10, 4)->default(0);

            $table->decimal('saldo', 10, 4)->default(0);

            $table->enum('status', ['EDITANDO','FINALIZADA','COBRANDO']);

            //$table->timestamps();

            //Relationship
            $table->foreign('client_id')->references('id')->on('clients')
              ->onDelete('cascade')
              ->onUpdate('cascade');

              $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('sales');
    }
}
