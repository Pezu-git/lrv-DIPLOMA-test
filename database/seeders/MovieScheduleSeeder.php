<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movie_schedules')->insert([
            'hall_id' => 1,
            'movie_id' => 1,
            'start_time' => '00:00',
        ]);

        DB::table('movie_schedules')->insert([
            'hall_id' => 1,
            'movie_id' => 2,
            'start_time' => '12:00',
        ]);

        DB::table('movie_schedules')->insert([
            'hall_id' => 1,
            'movie_id' => 3,
            'start_time' => '15:00',
        ]);
    }
}