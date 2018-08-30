<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CityHasEnterpriseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_has_enterprise', function (Blueprint $table) {
            $table->integer('enterprise_id')->unsigned()->index();
            $table->foreign('enterprise_id')->references('id')->on('enterprise')->onDelete('restrict');

            $table->integer('city_id')->unsigned()->index();
            $table->foreign('city_id')->references('id')->on('city')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city_has_enterprise');
    }
}
