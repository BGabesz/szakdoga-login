<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Edzo_idopont_Seeder extends Seeder
{
    public function run(){
        DB::table('edzo_idoponts')->insert([
            ['ugyfel' => '1','terem_id' => '1','belepes_datum_ido' => '2021-01-01 14:00:00','kilepes_datum_ido' => '2021-01-01 15:00:00'],
            ['ugyfel' => '3','terem_id' => '2','belepes_datum_ido' => '2021-01-02 10:00:00','kilepes_datum_ido' => '2021-01-02 12:00:00'],
            ['ugyfel' => '6','terem_id' => '1','belepes_datum_ido' => '2021-01-02 11:00:00','kilepes_datum_ido' => '2021-01-02 12:00:00'],
            ['ugyfel' => '7','terem_id' => '1','belepes_datum_ido' => '2021-01-03 08:00:00','kilepes_datum_ido' => '2021-01-03 09:00:00'],
            ['ugyfel' => '9','terem_id' => '1','belepes_datum_ido' => '2021-01-03 16:00:00','kilepes_datum_ido' => '2021-01-03 17:00:00'],
            ['ugyfel' => '11','terem_id' => '2','belepes_datum_ido' => '2021-01-07 08:00:00','kilepes_datum_ido' => '2021-01-07 10:00:00'],
            ['ugyfel' => '12','terem_id' => '1','belepes_datum_ido' => '2021-01-07 08:00:00','kilepes_datum_ido' => '2021-01-07 11:00:00'],
            ['ugyfel' => '14','terem_id' => '2','belepes_datum_ido' => '2021-01-07 09:00:00','kilepes_datum_ido' => '2021-01-07 10:00:00'],
            ['ugyfel' => '15','terem_id' => '2','belepes_datum_ido' => '2021-01-10 14:00:00','kilepes_datum_ido' => '2021-01-10 15:00:00'],
            ['ugyfel' => '18','terem_id' => '2','belepes_datum_ido' => '2021-01-12 10:00:00','kilepes_datum_ido' => '2021-01-12 11:00:00']
	]);
    }
}