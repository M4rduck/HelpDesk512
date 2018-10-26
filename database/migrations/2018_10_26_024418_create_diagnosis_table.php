<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosis', function (Blueprint $table) {
            $table->integer('incidence_id')->unsigned()->index();
            $table->foreign('incidence_id')->references('id')->on('incidence')->onDelete('restrict');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');

            $table->integer('form_id')->unsigned()->index();
            $table->foreign('form_id')->references('id')->on('form')->onDelete('restrict');

            $table->integer('section_id')->unsigned()->index();
            $table->foreign('section_id')->references('id')->on('section')->onDelete('restrict');

            $table->integer('sub_section_id')->unsigned()->index();
            $table->foreign('sub_section_id')->references('id')->on('sub_section')->onDelete('restrict');

            $table->integer('field_id')->unsigned()->index();
            $table->foreign('field_id')->references('id')->on('field')->onDelete('restrict');

            $table->primary(['user_id', 'form_id']);

            $table->string('value')->nullable(true);
            
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
        Schema::dropIfExists('diagnosis');
    }
}
