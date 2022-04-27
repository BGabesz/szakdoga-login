<?php

namespace App\Http\Controllers;

use App\Models\Oltozofoglalas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
    public function index()
    {
$letszam=$this->getLetszam();
return view("pages.index",["letszam"=>$letszam]);
    }
    private function getLetszam():int{
        
        return  Oltozofoglalas::where('datum','<',DB::RAW('NOW()'))
        ->whereRelation('szekreny','ures_e','F')
        ->whereIn(DB::raw("(szekreny_id, datum)"),function($query){
            $query->select('szekreny_id',DB::raw('MAX(datum)'))
                ->from('oltozofoglalas')
                ->groupBy('szekreny_id');
        })
        ->count();
    }
}
