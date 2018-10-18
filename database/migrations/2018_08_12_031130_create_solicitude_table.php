<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitude', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('area_id')->unsigned()->index();
            $table->foreign('area_id')->references('id')->on('area')->onDelete('restrict');
            $table->string('title')->comment('Solicitude\'s name');
            $table->string('description')->comment('brief description of the solicitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitude');
    }
}
