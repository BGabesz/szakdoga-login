<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eszkoz_tipus extends Model
{protected $primaryKey = 'eszkoz_tipus_szamlalo';
    protected $eszkoz_tipus = ['eszkoz_tipus_szamlalo', 'eszkoz_neve', 'suly', 'kep', 'leiras'];
    public function eszkozok(){
        return $this->hasMany(Eszkoz::class,"eszkoz_tipus_szamlalo");
    }
}
