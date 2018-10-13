<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldSubSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_sub_section', function (Blueprint $table) {
            $table->integer('field_id')->unsigned()->index();
            $table->foreign('field_id')->references('id')->on('field')->onDelete('restrict');

            $table->integer('sub_section_id')->unsigned()->index();
            $table->foreign('sub_section_id')->references('id')->on('sub_section')->onDelete('restrict');

            $table->integer('order');
            $table->string('value')->comment('default value if it contains');
            $table->string('options')->comment('Field that will contain the classes, id, etc of the fields, separated by comma, example field, value, field, value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('field_sub_section');
    }
}
