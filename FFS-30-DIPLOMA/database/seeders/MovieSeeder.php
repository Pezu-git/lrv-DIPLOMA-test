<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movies')->insert([
            'title' => 'Гарри Поттер и философский камень ',
            'duration' => 152,
        ]);

        DB::table('movies')->insert([
            'title' => 'Гарри Поттер и Тайная комната',
            'duration' => 174,
        ]);

        DB::table('movies')->insert([
            'title' => 'Гарри Поттер и узник Азкабана',
            'duration' => 142,
        ]);
    }
}