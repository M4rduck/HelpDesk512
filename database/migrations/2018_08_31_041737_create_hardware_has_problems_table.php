<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHardwareHasProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hardware_has_problems', function (Blueprint $table) {
            $table->integer('hardware_id')->unsigned()->index();
            $table->foreign('hardware_id')->references('id')->on('hardware')->onDelete('restrict');

            $table->integer('problems_id')->unsigned()->index();
            $table->foreign('problems_id')->references('id')->on('problems')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hardware_has_problems');
    }
}
