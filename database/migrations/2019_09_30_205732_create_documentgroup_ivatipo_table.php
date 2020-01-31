<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentgroupIvatipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentgroup_ivatipo', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('documentgroup_id')->unsigned();
            $table->bigInteger('ivatipo_id')->unsigned();

            //$table->timestamps();

            //Relationship
            $table->foreign('documentgroup_id')->references('id')->on('documentgroups');
            $table->foreign('ivatipo_id')->references('id')->on('ivatipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentgroup_ivatipo');
    }
}
