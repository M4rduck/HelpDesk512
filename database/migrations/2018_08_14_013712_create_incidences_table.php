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
        Schema::create('Incidence', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_agent'); //crear foreign key
            $table->unsignedInteger('id_solicitude'); //crear foreign key
            $table->string('contact', 45);
            $table->string('theme', 45);
            $table->unsignedInteger('id_incidenceState');
            $table->foreign('id_incidenceState')->references('id')->on('IncidenceState');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent']);
            $table->text('description');
            $table->string('evidence_route', 45);
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
