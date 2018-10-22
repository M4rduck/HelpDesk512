<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudeHasFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitude_has_forms', function (Blueprint $table) {
            $table->integer('solicitude_id')->unsigned()->index();
            $table->foreign('solicitude_id')->references('id')->on('solicitude')->onDelete('restrict');

            $table->integer('form_id')->unsigned()->index();
            $table->foreign('form_id')->references('id')->on('form')->onDelete('restrict');

            $table->integer('is_active')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitude_has_forms');
    }
}
