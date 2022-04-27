<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Eszkoz extends Model
{
    protected $primaryKey = 'eszkoz_id';
    protected $eszkoz = ['eszkoz_id', 'terem_id', 'eszkoz_tipus_szamlalo', 'qr_kod'];
    public function esz(){
        return $this->hasOne(Szekeny::class,'eszkoz_tipus_szamlalo','eszkoz_tipus_szamlalo');
    }
}
