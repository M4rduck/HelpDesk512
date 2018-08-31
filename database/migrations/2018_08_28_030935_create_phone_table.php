<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enterprise_id')->unsigned()->index();
            $table->foreign('enterprise_id')->references('id')->on('enterprise')->onDelete('restrict');
            $table->integer('visible')->default(1)->comment('1 for visible, 0 for no visible');
            $table->string('number')->comment('City\'s name');
            $table->string('type')->comment('Can be');
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
        Schema::dropIfExists('phone');
    }
}
