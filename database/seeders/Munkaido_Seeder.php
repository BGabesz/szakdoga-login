<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Munkaido_Seeder extends Seeder

{
    public function run(){
        DB::table('munkaidos')->insert([
            ['dolgozo' => '4','mettol' => '2022-02-02 08:00:00','meddig' => '2022-02-02 16:00:00'],
            ['dolgozo' => '22','mettol' => '2022-02-02 16:00:00','meddig' => '2022-02-02 22:00:00'],
            ['dolgozo' => '22','mettol' => '2022-02-03 08:00:00','meddig' => '2022-02-03 16:00:00'],
            ['dolgozo' => '4','mettol' => '2022-02-02 16:00:00','meddig' => '2022-02-02 22:00:00'],
            ['dolgozo' => '22','mettol' => '2022-02-04 08:00:00','meddig' => '2022-02-04 14:00:00'],
            ['dolgozo' => '4','mettol' => '2022-02-04 14:00:00','meddig' => '2022-02-04 22:00:00'],
            ['dolgozo' => '4','mettol' => '2022-02-05 08:00:00','meddig' => '2022-02-05 14:00:00'],
            ['dolgozo' => '22','mettol' => '2022-02-05 14:00:00','meddig' => '2022-02-05 22:00:00']
	]);
    }
}