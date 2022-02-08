<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HallConfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hall_confs')->insert([
            'rows' => 5,
            'cols' => 5
        ]);

        DB::table('hall_confs')->insert([
            'rows' => 6,
            'cols' => 6
        ]);
    }
}