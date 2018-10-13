<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionSubSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_sub_section', function (Blueprint $table) {
            $table->integer('sub_section_id')->unsigned()->index();
            $table->foreign('sub_section_id')->references('id')->on('sub_section')->onDelete('restrict');

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
        Schema::dropIfExists('section_sub_section');
    }
}
