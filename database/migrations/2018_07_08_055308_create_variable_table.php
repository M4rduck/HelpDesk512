<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variable', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('controller_id')->unsigned()->index();
            $table->foreign('controller_id')->references('id')->on('controller')->onDelete('restrict');
            $table->string('name')->comment('Name of the variable for the module');
            $table->string('value')->comment('Value for the variable');
            $table->string('description')->nullable(true)->comment('Brief description of what the variable does');
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
        Schema::dropIfExists('variable');
    }
}
