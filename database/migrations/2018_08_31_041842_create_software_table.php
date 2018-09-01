<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftwareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('software', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('descritpion')->nullable(true);
            $table->string('serial');
            $table->integer('has_license')->comment('1 to yes, 0 to no');
            $table->integer('has_module')->comment('1 to yes, 0 to no');
            $table->integer('is_active')->comment('1 to yes, 0 to no');
            $table->integer('is_deleted')->comment('1 to yes, 0 to no');
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
        Schema::dropIfExists('software');
    }
}
