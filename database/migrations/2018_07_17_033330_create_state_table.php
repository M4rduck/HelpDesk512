<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned()->index();
            $table->foreign('country_id')->references('id')->on('country')->onDelete('restrict');
            $table->integer('visible')->default(1)->comment('1 for visible, 0 for no visible');
            $table->integer('order')->comment('Customizable order in which they will be displayed ')->nullable(true);
            $table->string('name')->comment('State\'s name');
            $table->string('prefix')->comment('Area code for calls');
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
        Schema::dropIfExists('state');
    }
}
