<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollHasQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_has_question', function (Blueprint $table) {
            $table->integer('poll_id')->unsigned()->index();
            $table->foreign('poll_id')->references('id')->on('poll')->onDelete('restrict');

            $table->integer('question_id')->unsigned()->index();
            $table->foreign('question_id')->references('id')->on('question')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poll_has_question');
    }
}
