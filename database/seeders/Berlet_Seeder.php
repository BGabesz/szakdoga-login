<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Berlet_Seeder extends Seeder
{
    public function run(){
        DB::table('berlets')->insert([
            ['berlet_tipus_id' => '1','ugyfel' => '1','datum_tol' => '2021-01-01 08:00:00','datum_ig' => '2021-01-31 08:00:00'],
            ['berlet_tipus_id' => '1','ugyfel' => '3','datum_tol' => '2021-02-01 08:00:00','datum_ig' => '2021-03-02 08:00:00'],
            ['berlet_tipus_id' => '2','ugyfel' => '6','datum_tol' => '2021-01-01 08:00:00','datum_ig' => '2023-01-31 08:00:00'],
            ['berlet_tipus_id' => '2','ugyfel' => '7','datum_tol' => '2021-04-15 08:00:00','datum_ig' => '2023-05-16 08:00:00'],
            ['berlet_tipus_id' => '1','ugyfel' => '8','datum_tol' => '2022-03-01 08:00:00','datum_ig' => '2022-04-01 08:00:00']
	]);
    }
}