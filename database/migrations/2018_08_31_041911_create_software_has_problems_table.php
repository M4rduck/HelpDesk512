<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftwareHasProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('software_has_problems', function (Blueprint $table) {
            $table->integer('software_id')->unsigned()->index();
            $table->foreign('software_id')->references('id')->on('software')->onDelete('restrict');

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
        Schema::dropIfExists('software_has_problems');
    }
}
