<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('price_lists')->insert([
            'hall_id' => 1,
            'status' => 'standart',
            'price' => 300
        ]);

        DB::table('price_lists')->insert([
            'hall_id' => 1,
            'status' => 'vip',
            'price' => 500
        ]);

        DB::table('price_lists')->insert([
            'hall_id' => 2,
            'status' => 'standart',
            'price' => 350
        ]);

        DB::table('price_lists')->insert([
            'hall_id' => 2,
            'status' => 'vip',
            'price' => 550
        ]);
    }
}