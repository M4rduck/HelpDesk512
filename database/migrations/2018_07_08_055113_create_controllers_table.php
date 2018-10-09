<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControllersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controller', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('Name of the Class Controller');
            $table->string('containerName')->comment('Name of the module container');
            $table->string('prefix')->comment('Name of the route in the group');
            $table->boolean('status')->default(1)->comment('Status from controller, 1 for visible, 0 not visible');
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
        Schema::dropIfExists('controller');
    }
}
