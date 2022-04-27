<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Szekeny extends Model
{protected $primaryKey = 'szekreny_id';
    protected $fillable = ['szekreny_id', 'ures_e', 'tipusa'];
    
    
}
