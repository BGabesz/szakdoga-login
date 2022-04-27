<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;

class szemelyLekerdezController extends Controller
{
    public function index(Request $request){//ha van jó bérlete azt irassa ki szemely adataival
        $nev=$request->query('name');
        if($nev){
            $tabla=User::select('id')
            ->where('name','like','%'.$nev.'%')
            ->pluck('id');
            $tabla = trim($tabla, '[]');
            if($tabla){
                $ellenorzesVanEBerlete=User::where('name','like','%'.$nev.'%')
                    ->join('berlets','berlets.ugyfel','users.id')
                    ->join('berlet_tipuses','berlet_tipuses.berlet_tipus_id','berlets.berlet_tipus_id')
                    ->whereRaw("NOW() BETWEEN datum_tol AND datum_ig")
                    ->select('*',DB::raw("DATEDIFF(  datum_ig,now()) AS MegMeddigJo"))
                    ->first();
                if(!$ellenorzesVanEBerlete){
                    $seged=0;
                    $tabla=User::where('name','like','%'.$nev.'%')
                    ->get();
                    return $tabla->values()->all();
                }else{
                    $tabla=User::join('berlets','berlets.ugyfel','users.id')
                    ->join('berlet_tipuses','berlet_tipuses.berlet_tipus_id','berlets.berlet_tipus_id')
                    ->where('name','like','%'.$nev.'%')
                    ->whereRaw("NOW() BETWEEN datum_tol AND datum_ig")
                    ->select('*',DB::raw("DATEDIFF(  datum_ig,now()) AS MegMeddigJo"));
                    /* dd('van berlete'); */
                }
            }
        }
        return response()->json($tabla->get());
    }
}