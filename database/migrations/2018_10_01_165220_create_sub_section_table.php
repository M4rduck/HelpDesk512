<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_section', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('Sub section\'s type');
            $table->string('description')->comment('brief description of the sub section')->nullable(true);
            $table->integer('is_deleted')->comment('1 to yes, 0 to no')->default(0);
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
        Schema::dropIfExists('sub_section');
    }
}
