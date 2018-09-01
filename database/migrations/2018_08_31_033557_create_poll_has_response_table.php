<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollHasResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_has_response', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('poll_id')->unsigned()->index();
            $table->foreign('poll_id')->references('id')->on('poll')->onDelete('restrict');

            $table->integer('response_id')->unsigned()->index();
            $table->foreign('response_id')->references('id')->on('response')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poll_has_response');
    }
}
