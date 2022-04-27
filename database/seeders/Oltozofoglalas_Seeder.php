<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Oltozofoglalas_Seeder extends Seeder

{
    public function run(){
        DB::table('oltozofoglalas')->insert([
            ['szekreny_id' => '2','ugyfel' => '1','datum' => '2021-01-01 14:00:00'],
            ['szekreny_id' => '7','ugyfel' => '3','datum' => '2021-01-01 10:00:00'],
            ['szekreny_id' => '12','ugyfel' => '14','datum' => '2021-01-07 09:00:00'],
            ['szekreny_id' => '13','ugyfel' => '23','datum' => '2021-01-02 11:00:00'],
            ['szekreny_id' => '14','ugyfel' => '25','datum' => '2021-01-02 13:00:00']
	]);
    }
}
