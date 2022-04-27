<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Ugyfel_edzes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UgyfeledzesFelviszController extends Controller{
    public function felviszUgyfelFoglalas (Request $request){/* felviszUgyfelFoglalas */
        
        $request->validate([
            'ugyfelNev'=>'required',
            'datum'=>'required',
            'orara'=>'required',
            'ora'=>'required'
        ]);
        $szemelyNev=$request -> ugyfelNev;
        $tabla=User::select('id')
        ->where('name','like','%'.$szemelyNev.'%')
        ->pluck('id');
        $tabla = trim($tabla, '[]');
        if(strlen($tabla)>0){
            $ujfoglalas =new Ugyfel_edzes;

            $seged=($request -> datum);
            $seged2=($request -> orara);
            $seged3=$seged." ".$seged2;
            $ujfoglalas->edzo=auth()->user()->id;//vagy Auth::id()
            $ujfoglalas->ugyfel=$tabla;
            $ujfoglalas->datum=$seged3;
            $ujfoglalas->ora=$request -> ora;
            $ujfoglalas -> save();
            $ellenorzes=Ugyfel_edzes::where('ugyfel','=', $tabla)->where('datum','=', $seged3)->where('ora','=', $request -> ora)
            ->pluck('ugyfel');
            $tabla = trim($ellenorzes, '[]');;
            if(strlen($tabla)>0){
                return back()->with('sikeres','A foglalás sikeres volt');
            }else{
                return back()->with('sikertelen','A foglalás sikertelen volt');
            }
            return back()->with('sikertelen','A foglalás sikertelen volt');
        }
    }

}