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
            'title' => 'Гарри Поттер и философский камень',
            'duration' => 152,
            'description' => 'Первый фильм в серии лент о мальчике-волшебнике. Сирота Гарри Поттер получает приглашение на учёбу в волшебную школу Хогвартc',
            'country' => 'США'
        ]);

        DB::table('movies')->insert([
            'title' => 'Гарри Поттер и Тайная комната',
            'duration' => 174,
            'description' => 'Гарри Поттер переходит на второй курс Школы чародейства и волшебства Хогвартс.',
            'country' => 'США' 
        ]);

        DB::table('movies')->insert([
            'title' => 'Гарри Поттер и узник Азкабана',
            'duration' => 142,
            'description' => 'Гарри Поттер, Рон и Гермиона — возвращаются уже на третий курс школы чародейства и волшебства Хогвартс.',
            'country' => 'США' 
        ]);
    }
}