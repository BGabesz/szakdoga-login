<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terem extends Model
{ protected $primaryKey = 'terem_id';
    protected $terem = ['terem_id', 'terem_neve', 'ferfi_ferohely', 'noi_ferohely', 'nyitas', 'zaras'];
    public function eszkozok(){
        return $this->hasMany(Eszkoz::class,"terem_id");
    }
}
