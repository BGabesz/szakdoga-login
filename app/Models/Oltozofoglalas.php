<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Oltozofoglalas extends Model
{protected $primaryKey = 'oltozofog_id';
    protected $oltozofoglalas = ['oltozofog_id', 'szekreny_id', 'ugyfel', 'datum'];
   public function szekreny(){
       return $this->hasOne(Szekeny::class,'szekreny_id','szekreny_id');
   }
   
}
