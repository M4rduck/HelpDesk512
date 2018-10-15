<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('input_type_id')->unsigned()->index();
            $table->foreign('input_type_id')->references('id')->on('type_input')->onDelete('restrict');
            $table->integer('is_deleted')->comment('1 to yes, 0 to no')->default(0);
            $table->string('name')->comment('Field\'s type');
            $table->string('description')->comment('brief description of the field')->nullable(true);
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
        Schema::dropIfExists('field');
    }
}
