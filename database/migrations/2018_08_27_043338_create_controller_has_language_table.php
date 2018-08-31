<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControllerHasLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('controller_has_language', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('controller_id')->unsigned()->index();
            $table->foreign('controller_id')->references('id')->on('controller')->onDelete('restrict');

            $table->integer('language_id')->unsigned()->index();
            $table->foreign('language_id')->references('id')->on('language')->onDelete('restrict');

            $table->string('fileName')->comment('File\'s name')->nullable(false);
            $table->string('key')->comment('Key\'s name that will contain the message')->nullable(false);
            $table->string('value')->comment('Message that display to user')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('controller_has_language');
    }
}
