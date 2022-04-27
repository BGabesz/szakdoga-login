<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izomcsoport extends Model
{protected $primaryKey = 'izomcsoport_id';
    protected $izomcsoport = ['izomcsoport_id', 'megnevezes', 'abra'];
}
