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
            'hall_id' => 1,
            'rows' => 5,
            'cols' => 7
        ]);

        DB::table('hall_confs')->insert([
            'hall_id' => 2,
            'rows' => 6,
            'cols' => 7
        ]);
    }
}