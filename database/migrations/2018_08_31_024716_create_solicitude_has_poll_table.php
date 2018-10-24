<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudeHasPollTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitude_has_poll', function (Blueprint $table) {
            $table->integer('solicitude_id')->unsigned()->index();
            $table->foreign('solicitude_id')->references('id')->on('solicitude')->onDelete('restrict');

            $table->integer('poll_id')->unsigned()->index();
            $table->foreign('poll_id')->references('id')->on('poll')->onDelete('restrict');
            
            $table->integer('is_active')->default(1)->comment('1 to yes, 0 to no');
            $table->integer('is_delete')->default(0)->comment('1 to yes, 0 to no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitude_has_poll');
    }
}
