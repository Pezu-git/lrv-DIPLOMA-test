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
            'title' => 'Звёздные войны XXIII: Атака клонированных клонов',
            'duration' => 130,
        ]);

        DB::table('movies')->insert([
            'title' => 'Миссия выполнима',
            'duration' => 120,
        ]);

        DB::table('movies')->insert([
            'title' => 'Серая пантера',
            'duration' => 90,
        ]);
    }
}