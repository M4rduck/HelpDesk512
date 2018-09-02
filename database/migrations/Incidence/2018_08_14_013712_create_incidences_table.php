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
        Schema::create('incidences', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_agent');
            $table->foreign('id_agent')->references('id')->on('users');
            $table->unsignedInteger('id_solicitude');
            $table->foreign('id_solicitude')->references('id')->on('solicitudes');
            $table->unsignedInteger('id_contact');
            $table->foreign('id_contact')->references('id')->on('users');
            $table->string('theme', 100);
            $table->unsignedInteger('id_incidence_state');
            $table->foreign('id_incidence_state')->references('id')->on('incidence_states');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent']);
            $table->text('description');
            $table->string('evidence_route');
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
