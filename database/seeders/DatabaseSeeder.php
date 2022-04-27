<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([JogosultsagSeeder::class]);
        $this->call([User_Seeder::class]);
        $this->call([Ugyfel_edzes_Seeder::class]);
        $this->call([Munkaido_Seeder::class]);
        $this->call([Izomcsoport_Seeder::class]);
        $this->call([Terem_Seeder::class]);
        $this->call([Eszkoz_tipus_Seeder::class]);
        $this->call([Eszkoz_Seeder::class]);
        $this->call([Gyakorlat_Seeder::class]);
        $this->call([Edzo_idopont_Seeder::class]);
        $this->call([Szekeny_Seeder::class]);
        $this->call([Oltozofoglalas_Seeder::class]);
        $this->call([Berlet_tipus_Seeder::class]);
        $this->call([Arvaltozas_Seeder::class]);
        $this->call([Berlet_Seeder::class]);
       
}
}
