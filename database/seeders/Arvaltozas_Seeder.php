<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Arvaltozas_Seeder extends Seeder
{
    public function run(){
        DB::table('arvaltozas')->insert([
            ['berlet_tipus_id' => '1','regi_ar' => '8000','uj_ar' => '7500','mettol' => '2021-01-01 08:00:00','meddig' => '2021-02-01 08:00:00'],
            ['berlet_tipus_id' => '2','regi_ar' => '10000','uj_ar' => '7000','mettol' => '2021-06-01 08:00:00','meddig' => '2021-06-15 08:00:00'],
            ['berlet_tipus_id' => '2','regi_ar' => '10000','uj_ar' => '8000','mettol' => '2021-08-01 08:00:00','meddig' => '2021-09-01 08:00:00']
	]);
    }
}
