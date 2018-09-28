<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterpriseHasAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise_has_area', function (Blueprint $table) {
            $table->integer('enterprise_id')->unsigned()->index();
            $table->foreign('enterprise_id')->references('id')->on('enterprise')->onDelete('restrict');

            $table->integer('area_id')->unsigned()->index();
            $table->foreign('area_id')->references('id')->on('area')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enterprise_has_area');
    }
}
