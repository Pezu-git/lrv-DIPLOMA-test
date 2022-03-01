<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TakenSeatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ////////////////!Зал1 Сеанс1
        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 0,
            'seat_num' => 0,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 0,
            'seat_num' => 1,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 0,
            'seat_num' => 2,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 0,
            'seat_num' => 3,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 0,
            'seat_num' => 4,
            'taken' => false,
        ]);

        ///////////////

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 1,
            'seat_num' => 0,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 1,
            'seat_num' => 1,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 1,
            'seat_num' => 2,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 1,
            'seat_num' => 3,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 1,
            'seat_num' => 4,
            'taken' => false,
        ]);

        /////////////

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 2,
            'seat_num' => 0,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 2,
            'seat_num' => 1,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 2,
            'seat_num' => 2,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 2,
            'seat_num' => 3,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 2,
            'seat_num' => 4,
            'taken' => false,
        ]);

        /////////////////

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 3,
            'seat_num' => 0,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 3,
            'seat_num' => 1,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 3,
            'seat_num' => 2,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 3,
            'seat_num' => 3,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 3,
            'seat_num' => 4,
            'taken' => false,
        ]);

        /////////////

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 4,
            'seat_num' => 0,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 4,
            'seat_num' => 1,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 4,
            'seat_num' => 2,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 4,
            'seat_num' => 3,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 1,
            'row_num' => 4,
            'seat_num' => 4,
            'taken' => false,
        ]);

        ///////////////

        ////////////////!Зал1 сеанс2

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 0,
            'seat_num' => 0,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 0,
            'seat_num' => 1,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 0,
            'seat_num' => 2,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 0,
            'seat_num' => 3,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 0,
            'seat_num' => 4,
            'taken' => false,
        ]);

        ///////////////

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 1,
            'seat_num' => 0,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 1,
            'seat_num' => 1,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 1,
            'seat_num' => 2,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 1,
            'seat_num' => 3,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 1,
            'seat_num' => 4,
            'taken' => false,
        ]);

        /////////////

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 2,
            'seat_num' => 0,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 2,
            'seat_num' => 1,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 2,
            'seat_num' => 2,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 2,
            'seat_num' => 3,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 2,
            'seat_num' => 4,
            'taken' => false,
        ]);

        /////////////////

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 3,
            'seat_num' => 0,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 3,
            'seat_num' => 1,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 3,
            'seat_num' => 2,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 3,
            'seat_num' => 3,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 3,
            'seat_num' => 4,
            'taken' => false,
        ]);

        /////////////

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 4,
            'seat_num' => 0,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 4,
            'seat_num' => 1,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 4,
            'seat_num' => 2,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 4,
            'seat_num' => 3,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 2,
            'row_num' => 4,
            'seat_num' => 4,
            'taken' => false,
        ]);

        ////////////

        ////////////////!Зал1 Сеанс3

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 0,
            'seat_num' => 0,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 0,
            'seat_num' => 1,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 0,
            'seat_num' => 2,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 0,
            'seat_num' => 3,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 0,
            'seat_num' => 4,
            'taken' => false,
        ]);

        ///////////////

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 1,
            'seat_num' => 0,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 1,
            'seat_num' => 1,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 1,
            'seat_num' => 2,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 1,
            'seat_num' => 3,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 1,
            'seat_num' => 4,
            'taken' => false,
        ]);

        /////////////

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 2,
            'seat_num' => 0,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 2,
            'seat_num' => 1,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 2,
            'seat_num' => 2,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 2,
            'seat_num' => 3,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 2,
            'seat_num' => 4,
            'taken' => false,
        ]);

        /////////////////

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 3,
            'seat_num' => 0,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 3,
            'seat_num' => 1,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 3,
            'seat_num' => 2,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 3,
            'seat_num' => 3,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 3,
            'seat_num' => 4,
            'taken' => false,
        ]);

        /////////////

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 4,
            'seat_num' => 0,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 4,
            'seat_num' => 1,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 4,
            'seat_num' => 2,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 4,
            'seat_num' => 3,
            'taken' => false,
        ]);

        DB::table('taken_seats')->insert([
            'hall_id' => 1,
            'seance_id' => 3,
            'row_num' => 4,
            'seat_num' => 4,
            'taken' => false,
        ]);
    }
}
