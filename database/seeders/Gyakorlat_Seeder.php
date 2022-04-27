<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Gyakorlat_Seeder extends Seeder
{
    public function run(){
        DB::table('gyakorlats')->insert([
            ['eszkoz_tipus_szamlalo'=>1,'izomcsoport_id'=>3,'megnevezes'=>'Bicepsz ülve egykezes súlyzókkal','video'=>'BicepszUlveEgykezesSulyzokkalVideo','leiras'=>'Leiaras Karhajlitas nyujtas...','szint'=>1],
            ['eszkoz_tipus_szamlalo'=>4,'izomcsoport_id'=>3,'megnevezes'=>'Bicepsz ülve egykezes súlyzókkal','video'=>'BicepszUlveEgykezesSulyzokkalVideo','leiras'=>'Leiaras Karhajlitas nyujtas...','szint'=>1],
            ['eszkoz_tipus_szamlalo'=>1,'izomcsoport_id'=>3,'megnevezes'=>'Koncentrált bicepsz','video'=>'KoncentraltBicepszVideo','leiras'=>'Leiaras Karhajlitas nyujtas...','szint'=>1],
            ['eszkoz_tipus_szamlalo'=>4,'izomcsoport_id'=>3,'megnevezes'=>'Koncentrált bicepsz','video'=>'KoncentraltBicepszVideo','leiras'=>'Leiaras Karhajlitas nyujtas...','szint'=>1],          
            ['eszkoz_tipus_szamlalo'=>1,'izomcsoport_id'=>3,'megnevezes'=>'Kalapács bicepsz','video'=>'KarhajliatasNyujtasVideo','leiras'=>'Leiaras Karhajlitas nyujtas...','szint'=>2],
            ['eszkoz_tipus_szamlalo'=>1,'izomcsoport_id'=>3,'megnevezes'=>'Bicepsz ülve ferdepadon egykezes súlyzókkal','video'=>'BicepszUlveFerdepadonVideo','leiras'=>'Leiaras Karhajlitas nyujtas...','szint'=>1],
            ['eszkoz_tipus_szamlalo'=>4,'izomcsoport_id'=>3,'megnevezes'=>'Bicepsz ülve ferdepadon egykezes súlyzókkal','video'=>'BicepszUlveFerdepadonVideo','leiras'=>'Leiaras Karhajlitas nyujtas...','szint'=>1],
            ['eszkoz_tipus_szamlalo'=>1,'izomcsoport_id'=>3,'megnevezes'=>'Bicepsz állva váltott karral','video'=>'BicepszAllvaValtottKarralVideo','leiras'=>'Leiaras Karhajlitas nyujtas...','szint'=>3],
            ['eszkoz_tipus_szamlalo'=>2,'izomcsoport_id'=>3,'megnevezes'=>'Bicepsz állva kétkezes rúddal','video'=>'BicepszAllvaKetkezesRuddalVideo','leiras'=>'Leiaras Karhajlitas nyujtas...','szint'=>1],
            ['eszkoz_tipus_szamlalo'=>3,'izomcsoport_id'=>3,'megnevezes'=>'Bicepsz állva francia rúddal ','video'=>'BicepszAllvaFranciaRuddalVideo','leiras'=>'Leiaras Karhajlitas nyujtas...','szint'=>2],
            ['eszkoz_tipus_szamlalo'=>3,'izomcsoport_id'=>3,'megnevezes'=>'Bicepsz Scott-padon ','video'=>'BicepszScottPadonVideo','leiras'=>'Leiaras Karhajlitas nyujtas...','szint'=>1],
            ['eszkoz_tipus_szamlalo'=>2,'izomcsoport_id'=>3,'megnevezes'=>'Kábeles kétkezes bicepszezés ülve ','video'=>'KábelesKétkezesBicepszezesUlveVido','leiras'=>'Leiaras Karhajlitas nyujtas...','szint'=>3],
            ['eszkoz_tipus_szamlalo'=>3,'izomcsoport_id'=>3,'megnevezes'=>'Kábeles kétkezes bicepszezés állva csigával','video'=>'KábelesKétkezesBicepszezesAllvaVido','leiras'=>'Leiaras Karhajlitas nyujtas...','szint'=>1]
	]);
    }
}