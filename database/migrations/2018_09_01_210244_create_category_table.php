<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorys', function (Blueprint $table) {
            $table->integer('knowledgebase_id')->unsigned()->index();
            $table->foreign('knowledgebase_id')->references('id')->on('knowledgebase')->onDelete('restrict')->nullable(true);         

            $table->integer('problem_id')->unsigned()->index();
            $table->foreign('problem_id')->references('id')->on('problems')->onDelete('restrict')->nullable(true);         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
    }
}
