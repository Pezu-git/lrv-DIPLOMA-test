<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seats')->insert([
            'hall_id' => 1,
            'row_num' => 0,
            'seat_num' => 0,
            'status' => 'standard'
        ]);

        DB::table('seats')->insert([
            'hall_id' => 1,
            'row_num' => 0,
            'seat_num' => 1,
            'status' => 'standard'
        ]);

        DB::table('seats')->insert([
            'hall_id' => 1,
            'row_num' => 0,
            'seat_num' => 2,
            'status' => 'disabled'
        ]);

        DB::table('seats')->insert([
            'hall_id' => 1,
            'row_num' => 0,
            'seat_num' => 3,
            'status' => 'standard'
        ]);

        DB::table('seats')->insert([
            'hall_id' => 1,
            'row_num' => 0,
            'seat_num' => 4,
            'status' => 'standard'
        ]);

        //////////////////////
        DB::table('seats')->insert([
            'hall_id' => 1,
            'row_num' => 1,
            'seat_num' => 0,
            'status' => 'disabled'
        ]);

        DB::table('seats')->insert([
            'hall_id' => 1,
            'row_num' => 1,
            'seat_num' => 1,
            'status' => 'standard'
        ]);

        DB::table('seats')->insert([
            'hall_id' => 1,
            'row_num' => 1,
            'seat_num' => 2,
            'status' => 'vip'
        ]);

        DB::table('seats')->insert([
            'hall_id' => 1,
            'row_num' => 1,
            'seat_num' => 3,
            'status' => 'standard'
        ]);

        DB::table('seats')->insert([
            'hall_id' => 1,
            'row_num' => 1,
            'seat_num' => 4,
            'status' => 'standard'
        ]);

        ////////////////////
        DB::table('seats')->insert([
            'hall_id' => 1,
            'row_num' => 2,
            'seat_num' => 0,
            'status' => 'standard'
        ]);

        DB::table('seats')->insert([
            'hall_id' => 1,
            'row_num' => 2,
            'seat_num' => 1,
            'status' => 'standard'
        ]);

        DB::table('seats')->insert([
            'hall_id' => 1,
            'row_num' => 2,
            'seat_num' => 2,
            'status' => 'standard'
        ]);

        DB::table('seats')->insert([
            'hall_id' => 1,
            'row_num' => 2,
            'seat_num' => 3,
            'status' => 'standard'
        ]);

        DB::table('seats')->insert([
            'hall_id' => 1,
            'row_num' => 2,
            'seat_num' => 4,
            'status' => 'standard'
        ]);
    }
}