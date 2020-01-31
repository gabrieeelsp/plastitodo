<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
          $table->bigIncrements('id');

          $table->string('name', 128);
          $table->string('slug', 128)->unique();

          $table->decimal('saldo', 10, 4)->default(0);

          $table->enum('tipo', ['Minorista','Mayorista']);

          $table->string('direccion', 128)->nullable();
          $table->string('telefono', 128)->nullable();

          $table->string('comentario', 512)->nullable();

          $table->bigInteger('ivatipo_id')->unsigned();

          //$table->timestamps();

          //Relationship
          $table->foreign('ivatipo_id')->references('id')->on('ivatipos')
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
        Schema::dropIfExists('clients');
    }
}
