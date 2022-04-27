<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Izomcsoport_Seeder extends Seeder

{
    public function run(){
        DB::table('izomcsoports')->insert([
            ['megnevezes' => 'Mellizom','abra' => 'MellKép'],
            ['megnevezes' => 'Tricepsz','abra' => 'TricepszKép'],
            ['megnevezes' => 'Bicepsz','abra' => 'BicepszKép'],
            ['megnevezes' => 'Vádli','abra' => 'VádliKép' ],
            ['megnevezes' => 'Combizom','abra' => 'CombKép'],
            ['megnevezes' => 'Hátizom','abra' => 'HátKép'],
            ['megnevezes' => 'Hasizom','abra' => 'HasKép'],
            ['megnevezes' => 'Alkar','abra' => 'AlkarKép'],
            ['megnevezes' => 'Vállizom','abra' => 'VállKép'],
            ['megnevezes' => 'Törzs','abra' => 'TörzsKép']
	]);
    }
}