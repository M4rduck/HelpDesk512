<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterpriseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_name')->nullable(false)->comment('official and legal name');
            $table->string('address')->nullable(false)->comment('Main address');
            $table->string('legal_representative')->nullable(false)->comment('legal representative\'s name');
            $table->boolean('visible')->nullable(false)->comment('1 for active, 0 for no active');
            $table->boolean('sw_active')->default(1)->nullable(false)->comment('1 for active, 0 for no active');
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
        Schema::dropIfExists('enterprise');
    }
}
