<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_section', function (Blueprint $table) {
            $table->integer('form_id')->unsigned()->index();
            $table->foreign('form_id')->references('id')->on('form')->onDelete('restrict');

            $table->integer('section_id')->unsigned()->index();
            $table->foreign('section_id')->references('id')->on('section')->onDelete('restrict');

            $table->integer('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_section');
    }
}
