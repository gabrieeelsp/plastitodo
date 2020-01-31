<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebitnotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debitnotes', function (Blueprint $table) {
          $table->bigIncrements('id');

          $table->bigInteger('client_id')->unsigned()->nullable();

          $table->bigInteger('user_id')->unsigned();

          $table->enum('status', ['EDITANDO', 'CONFIRMADO']);

          $table->decimal('saldo', 10, 4)->default(0);

          $table->decimal('total', 10, 4)->default(0);

          $table->dateTime('created_at');

          $table->string('comentario', 512)->nullable();

          $table->enum('tipo_comprobante', ['A','B','TZ'])->nullable();

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
        Schema::dropIfExists('debitnotes');
    }
}
