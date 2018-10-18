<?php

use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('area')->insert([
            [
                'name' => 'Servicios IT',
                'extension' => '345',
                'email' => 'serviciosit@helpdesk.edu.co',
                'description' => '6 piso',
            ],
            [
                'name' => 'Recursos humanos',
                'extension' => '607',
                'email' => 'rhh@helpdesk.edu.co',
                'description' => '2 piso',
            ]
        ]);
    }
}
