<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidence', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_agent');
            $table->foreign('id_agent')->references('id')->on('users');
            $table->unsignedInteger('id_solicitude');
            $table->foreign('id_solicitude')->references('id')->on('solicitude');
            $table->unsignedInteger('id_contact');
            $table->foreign('id_contact')->references('id')->on('users');
            $table->string('theme', 100);
            $table->unsignedInteger('id_incidence_state');
            $table->foreign('id_incidence_state')->references('id')->on('incidence_state');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent']);
            $table->text('description');
            $table->string('evidence_route')->nullabe()->change();
            $table->string('label', 45);
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
        Schema::dropIfExists('incidences');
    }
}
