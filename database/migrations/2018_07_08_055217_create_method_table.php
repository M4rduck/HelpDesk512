<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('method', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('controller_id')->unsigned()->index();
            $table->foreign('controller_id')->references('id')->on('controller')->onDelete('restrict');
            $table->string('verbName')->comment('Name of the verb HTTP, can be post, get, put, patch, delete or resource');
            $table->string('name_function')->nullable(true)->comment('Name of the function, except if verbName is resource');
            $table->string('url')->comment('Name of the url to show');
            $table->string('name')->nullable(true)->comment('Name of the route, except if verbName is resource');
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
        Schema::dropIfExists('method');
    }
}
