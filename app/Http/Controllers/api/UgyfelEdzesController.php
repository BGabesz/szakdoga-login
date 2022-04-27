<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Ugyfel_edzes;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UgyfelEdzesController extends Controller{
    public function index(Request $request){//összekapcsolja a users táblával és visszaadja azokat az elemeket amiket a selectbe vannak
        $datumSzemelyel=$request->query('datumTolIgSzemellyel');
        if($datumSzemelyel){
            $tabla=Ugyfel_edzes::join('users','users.id','ugyfel_edzes.ugyfel')
                ->select('ugyfel_edzes.edzo','ugyfel_edzes.ugyfel','users.name','ugyfel_edzes.datum','ugyfel_edzes.ora',)
                ->Where('datum','>=',substr($datumSzemelyel,0,10))
                ->Where('datum','<=',substr($datumSzemelyel,11,22))
                ->Where('name','like','%'.substr($datumSzemelyel,22).'%')
                /* ->Where('ugyfel_edzes.edzo','=','24') */
                ->Where('ugyfel_edzes.edzo','=',Auth::id())
                ->get();
                /* dd(Auth::id()); */
        }else{
            $tabla= Ugyfel_edzes::join('users','users.id','ugyfel_edzes.ugyfel')
                ->select('ugyfel_edzes.edzo','ugyfel_edzes.ugyfel','users.name','ugyfel_edzes.datum','ugyfel_edzes.ora',)
                /* ->Where('ugyfel_edzes.edzo','=',auth()->user()->id) */
                ->get();
        }
        $rendez=$tabla->sortBy('datum');
        $rendez->all();
        return $rendez->values()->all();
    }
    public function delete(Request $request){
        $original=$request->all();
        Ugyfel_edzes::where([
           ['edzo',$original['edzo']],
           ['ugyfel',$original['ugyfel']],
           ['datum',$original['datum']],
           ['ora',$original['ora']],
       ])->delete();
       
        return response()->json(true);
     }
     public function update(Request $request){
        $request->validate([
            'nevUj'=>'required',
            'datumUj'=>'required',
            'oraUj'=>'required',
            'nevR'=>'required',
            'datumR'=>'required',
            'oraR'=>'required',
            'ugyfelR'=>'required',
            'edzo'=>'required',
        ]);
        $original=$request->all();
        $szemely=User::select("id")
            ->where('name','like','%'.$request -> nevUj.'%')
            ->pluck('id');
        $szemely = trim($szemely, '[]');
        Ugyfel_edzes::where([
            ['edzo',$original['edzo']],
            ['ugyfel',$original['ugyfelR']],
            ['datum',$original['datumR']],
            ['ora',$original['oraR']],
        ])->update(['ugyfel' => $szemely,
            'datum' => $request -> datumUj,
            'ora' => $request -> oraUj,]);

        return response()->json(true);
    }
}
