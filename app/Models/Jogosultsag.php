<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogosultsag extends Model
{protected $primaryKey = 'jogosultsag_id';
    protected $jogosultsag = ['jogosultsag_id', 'nev'];
}
