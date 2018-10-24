<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        Schema::table('solicitude', function ($table) {
            $table->string('evidence_route')->nullable();
        });
    }
}
