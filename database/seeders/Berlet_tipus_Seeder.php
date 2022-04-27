<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Berlet_tipus_Seeder extends Seeder
{
    public function run(){
        DB::table('berlet_tipuses')->insert([
            ['megnevezes' => 'diak','idotartam_nap' => '30','ar' => 3000],
            ['megnevezes' => 'teljes áru','idotartam_nap' => '30','ar' => 3000],
            ['megnevezes' => 'rendor','idotartam_nap' => '30','ar' => 2900],
            ['megnevezes' => 'diak éves','idotartam_nap' => '365','ar' => 30000],
            ['megnevezes' => 'rendor éves','idotartam_nap' => '365','ar' => 29000],
            ['megnevezes' => 'teljes áru éves','idotartam_nap' => '365','ar' => 35000]
	]);
    }
}