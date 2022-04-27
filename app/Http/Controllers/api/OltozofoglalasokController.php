<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Oltozofoglalas;
use App\Models\User;
use App\Models\Berlet;
use App\Models\Szekeny;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
class OltozofoglalasokController extends Controller
{
    public function index(Request $request)
    { $sort=$request->query ('_sort');
        $order=$request->query ('_order');
        $q=$request->query('q');
        $oltozofoglalasok=Oltozofoglalas::selectRaw("*");
        if($sort&&$order){
            $oltozofoglalasok->orderBy($sort,$order);
        }
        if($q){
            
            foreach ( Schema::getColumnListing("oltozofoglalas") as $column) {
               // dd(Schema::getColumnType("szemelies",$column));
                $oltozofoglalasok->orWhere($column,'like','%'.$q.'%');
                $oltozofoglalasok->orWhere($column,$q);
            };
        }
        //$szemelyek= ($sort&&$order) ? Szemely::orderBy($sort,$order)->get(): Szemely::all();
      
       
        //dd($szemelyek->toSql());

        return response()->json($oltozofoglalasok->get());
    }

    public function store(Request $request){
        $szekrenyId=$request->input("szekreny_id");
        $ugyfel=$request->input("ugyfel");
        $datum=$request->input("datum");


    $eszkoz=new Oltozofoglalas;
    $eszkoz->szekreny_id=$szekrenyId;
    $eszkoz->ugyfel=$ugyfel;
    $eszkoz->datum=$datum;
    $eszkoz->save();
  

    return response()->json(true);}
public function update(Request $request,string $oltozofoglalasId)
{
$szekrenyId=$request->input("szekreny_id");
$ugyfel=$request->input("ugyfel");
$datum=$request->input("datum");


    $oltozofoglalas=Oltozofoglalas::find($oltozofoglalasId);
    $oltozofoglalas->szekreny_id=$szekrenyId;
    $oltozofoglalas->ugyfel=$ugyfel;
    $oltozofoglalas->datum=$datum;
    $oltozofoglalas->save();
  

    return response()->json(true);
    
}
public function destroy(string $oltozofoglalasId){
    $oltozofoglalas=Oltozofoglalas::find($oltozofoglalasId);
   
    $oltozofoglalas->delete();
    return response()->json(true);
}

public function letszamNaponta(){
    $oltozok=Oltozofoglalas::selectRaw("date(datum) as napok,count(1) as letszam")
        ->groupByRaw('date(datum)')->get();
        return response()->json( $oltozok);
}
public function OltozoFoglalas(Request $request){//recepció oldalhoz
    $request->validate([
        'ugyfelNev'=>'required',
        'szekrenySzama'=>'required|integer'
    ]);
    $szemelyNev=$request -> ugyfelNev;
    $szekrenySzam=$request -> szekrenySzama;
    $szoveg="";
    $seged=false;
    $szemely=User::selectRaw('*')
        ->Where('name','like','%'.$szemelyNev.'%')
        ->first();
    if ($szemely) {
        $szoveg.="Talált ilyen embert";
        $berlet=Berlet::selectRaw('*')
        ->Where('ugyfel','=',$szemely->id)
        ->Where('datum_tol','<=',Now())
        ->Where('datum_ig','>=',Now())
        ->first();
        if($berlet){
            $szoveg.=", van bérlete";
            $szekreny=Szekeny::selectRaw('*')
            ->Where('szekreny_id','=',$szekrenySzam)
            ->Where('ures_e','=','Ü')
            ->first();
            if($szekreny){
                $szoveg.=", üres volt a szekrény";
                $seged=true; 
                $ujfoglalas =new Oltozofoglalas;
                $ujfoglalas->szekreny_id=$szekrenySzam;
                $ujfoglalas->ugyfel=$szemely->id;
                $ujfoglalas->datum=Now();//1 órával kevesebbet ad
                $ujfoglalas->save();
                Szekeny::orWhere('szekreny_id', $szekrenySzam)
                ->update(['ures_e' => 'F']);
                
            }else if(!$szekreny){
                $szoveg.=",HIBA de nem  volt üres a szekrény";
            }
        }else if(!$berlet){
            $szoveg.=",HIBA de nincs jelenleg bérlete";
        }
     }else if(!$szemely){
        $szoveg.=" HIBA,Nem talált ilyen embert";
     }
    
    
    if($seged){//ha igaz akkor
        return back()->with('sikeres','A foglalás sikeres volt '.$szoveg);
    }else{//ha hamis akkor
        return back()->with('sikertelen','A foglalás sikertelen volt '.$szoveg);
    }


}

}
