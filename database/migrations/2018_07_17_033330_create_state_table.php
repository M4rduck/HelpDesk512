<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_ud')->unsigned()->index();
            $table->foreign('country_ud')->references('id')->on('country')->onDelete('restrict');
            $table->integer('visible')->default(1)->comment('1 for visible, 0 for no visible');
            $table->integer('order');
            $table->string('name');
            $table->string('prefix')->comment('Area code for calls');
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
        Schema::dropIfExists('state');
    }
}
