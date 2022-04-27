<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Berlet_tipus extends Model
{
    protected $primaryKey='berlet_tipus_id';
    protected $berlet_tipus = ['berlet_tipus_id', 'megnevezes', 'idotartam_nap', 'ar'];

    public function getAraAttribute()
    {
        $arvalt= Arvaltozas::where("berlet_tipus_id",$this->attributes["berlet_tipus_id"])
        ->where("mettol","<=",DB::raw("CURRENT_DATE()"))
        ->where("meddig",">=",DB::raw("CURRENT_DATE()"))->first();

        return $arvalt ? $arvalt->uj_ar : $this->attributes["ar"];
    }
    public function eszkozok(){
        return $this->hasMany(Berlet::class,"berlet_tipus_id");
    }
    public function valtozasok(){
        return $this->hasMany(Arvaltozas::class,"berlet_tipus_id");
    }
}