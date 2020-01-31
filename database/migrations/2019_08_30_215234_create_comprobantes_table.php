<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprobantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprobantes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('client_id')->unsigned()->nullable();

            $table->dateTime('created_at');

            $table->enum('tipo', ['FCA','NCA', 'NDA', 'FCB','NCB', 'NDB', 'FCTZ','NCTZ', 'NDTZ']);

            $table->string('numero');

            $table->decimal('valor', 8, 4)->default(0);

            //$table->timestamps();

            //Relationship
            $table->foreign('client_id')->references('id')->on('clients')
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
        Schema::dropIfExists('comprobantes');
    }
}
