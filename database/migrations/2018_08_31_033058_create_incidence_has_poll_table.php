<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidenceHasPollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidence_has_poll', function (Blueprint $table) {
            $table->integer('incidence_id')->unsigned()->index();
            $table->foreign('incidence_id')->references('id')->on('incidences')->onDelete('restrict');

            $table->integer('poll_id')->unsigned()->index();
            $table->foreign('poll_id')->references('id')->on('poll')->onDelete('restrict');

            $table->integer('question_id')->unsigned()->index();
            $table->foreign('question_id')->references('id')->on('question')->onDelete('restrict');

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
        Schema::dropIfExists('incidence_has_poll');
    }
}
