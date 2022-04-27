<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Terem_Seeder extends Seeder

{
    public function run(){
        DB::table('terems')->insert([
            ['terem_neve' => 'Elso Terem','ferfi_ferohely' => '50','noi_ferohely' => '50','nyitas' => '06:00','zaras' => '22:00'],
            ['terem_neve' => 'Masodik Terem','ferfi_ferohely' => '50','noi_ferohely' => '50','nyitas' => '06:00','zaras' => '22:00'],
            ['terem_neve' => 'Harmadik Terem','ferfi_ferohely' => '50','noi_ferohely' => '50','nyitas' => '06:00','zaras' => '22:00'],
            ['terem_neve' => 'Negyedik Terem','ferfi_ferohely' => '50','noi_ferohely' => '50','nyitas' => '06:00','zaras' => '22:00']
	]);
    }
}