<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNdcomprobantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ndcomprobantes', function (Blueprint $table) {
          $table->bigIncrements('id');

          $table->bigInteger('client_id')->unsigned()->nullable();

          $table->bigInteger('debitnote_id')->unsigned();

          $table->dateTime('created_at');

          $table->enum('tipo', ['NDA', 'NDB', 'NDTZ']);

          $table->string('numero');

          $table->decimal('valor', 8, 4)->default(0);

          //$table->timestamps();

          //Relationship
          $table->foreign('client_id')->references('id')->on('clients')
            ->onDelete('cascade')
            ->onUpdate('cascade');

          $table->foreign('debitnote_id')->references('id')->on('debitnotes')
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
        Schema::dropIfExists('ndcomprobantes');
    }
}
