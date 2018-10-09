<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('method_id')->unsigned()->index();
            $table->foreign('method_id')->references('id')->on('method')->onDelete('restrict')->nullable(true);
            $table->integer('module_id')->nullable(true)->unsigned()->index();
            $table->foreign('module_id')->references('id')->on('module_menu')->onDelete('restrict');
            $table->integer('order')->comment('Order that show the modules');
            $table->string('text')->comment('Name of the module that show in the menu');
            $table->string('icon')->default('circle')->comment('Name of the icon to show in the menu, watch names in fontawesome');
            $table->string('icon_color')->nullable(true);
            $table->string('label')->nullable(true)->comment('Text that show next to module\'s name');
            $table->string('label_color')->nullable(true)->comment('Name of the color for the label, can be the color\'s name in ui Elements, System in adminLTE');
            $table->boolean('main')->default(1)->comment('indicates whether the module is main or a submenu, 1 for itself, 0 for not');
            $table->integer('resource');
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
        Schema::dropIfExists('module');
    }
}
