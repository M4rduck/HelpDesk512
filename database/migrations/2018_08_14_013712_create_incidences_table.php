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
            $table->string('contacto');
            $table->string('tema');
            $table->enum('estado', ['abierto', 'pendiente', 'resuelto', 'cerrado']);
            $table->enum('prioridad', ['bajo', 'medio', 'alto', 'urgente']);
            $table->string('agente');
            $table->text('descripcion');
            $table->string('ruta_evidencia');
            $table->string('etiquetas');
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
