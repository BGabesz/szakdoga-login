<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Szekeny;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
class SzekrenyekController extends Controller
{
    public function index(Request $request){ 
        $sort=$request->query ('_sort');
        $order=$request->query ('_order');
        $q=$request->query('q');
        $id=$request->query('id');
        $idRossz=$request->query('idRossz');
        $pontosSz=$request->query('pontosSzekreny');
        $mireSzures = $request->query('szuro');

        $szekrenyek=Szekeny::selectRaw("*");
        if($sort&&$order){
            $szekrenyek->orderBy($sort,$order);
        }
        if($q){
            
            foreach ( Schema::getColumnListing("szekenies") as $column) {
               // dd(Schema::getColumnType("szemelies",$column));
                $szekrenyek->orWhere($column,'like','%'.$q.'%');
                $szekrenyek->orWhere($column,$q);
            };
        }
        if($id){
            $oltozofoglalas=Szekeny::find($id);
            
            $oltozofoglalas->ures_e="Ü";
            $oltozofoglalas->save();
        }
        if($idRossz){
            $oltozofoglalas=Szekeny::find($idRossz);
            if($oltozofoglalas->ures_e=="R"){
                $oltozofoglalas->ures_e="Ü";
            }else if($oltozofoglalas->ures_e=="Ü"){
                $oltozofoglalas->ures_e="R";
            }else if($oltozofoglalas->ures_e=="F"){
                $oltozofoglalas->ures_e="R";
            }
            $oltozofoglalas->save();
        }
        
        if($pontosSz){//g
            $pontosSz=$request->query('pontosSzekreny');
            $szekrenyek->where('szekreny_id','like',$pontosSz);
            return response()->json($szekrenyek->get());
        }
        if ($mireSzures) {//g
            if ($mireSzures === "osszes") {
            } else if ($mireSzures === "osszesN") {
                $szekrenyek->where('tipusa', '=', 'Nő');
            } else if ($mireSzures === "osszesF") {
                $szekrenyek->where('tipusa', '=', 'Férfi');
            } else if ($mireSzures === "Üres") { //--
                $szekrenyek->where('ures_e', '=', 'Ü');
            } else if ($mireSzures === "ÜresNő") {
                $szekrenyek->where('tipusa', '=', 'Nő');
                $szekrenyek->where('ures_e', '=', 'Ü');
            } else if ($mireSzures === "ÜresFérfi") {
                $szekrenyek->where('tipusa', '=', 'Férfi');
                $szekrenyek->where('ures_e', '=', 'Ü');
            } else if (($mireSzures === "Foglalt")) { //--
                $szekrenyek->where('ures_e', '=', 'F');
            } else if (($mireSzures === "FoglaltN")) {
                $szekrenyek->where('tipusa', '=', 'Nő');
                $szekrenyek->where('ures_e', '=', 'F');
            } else if (($mireSzures === "FoglaltF")) {
                $szekrenyek->where('tipusa', '=', 'Férfi');
                $szekrenyek->where('ures_e', '=', 'F');
            } else if (($mireSzures === "Rossz")) { //--
                $szekrenyek->where('ures_e', '=', 'R');
            } else if (($mireSzures === "RrosszN")) {
                $szekrenyek->where('ures_e', '=', 'R');
                $szekrenyek->where('tipusa', '=', 'Nő');
            } else if (($mireSzures === "RrosszF")) {
                $szekrenyek->where('ures_e', '=', 'R');
                $szekrenyek->where('tipusa', '=', 'Férfi');
            }
        }
        return response()->json($szekrenyek->get());
        
        //$szemelyek= ($sort&&$order) ? Szemely::orderBy($sort,$order)->get(): Szemely::all();
      
       
        //dd($szemelyek->toSql());

    }
    public function store(Request $request){
        $urese=$request->input("ures_e");
  $tipusa=$request->input("tipusa");

 
        $szekreny=new Szekeny;
        $szekreny->ures_e=$urese;
        $szekreny->tipusa=$tipusa;
        $szekreny->save();
      

        return response()->json(true);
    }

    public function update(Request $request,string $szekrenyId)
    {
  $urese=$request->input("ures_e");
  $tipusa=$request->input("tipusa");

 
        $szekreny=Szekeny::find($szekrenyId);
        $szekreny->ures_e=$urese;
        $szekreny->tipusa=$tipusa;
        $szekreny->save();
      

        return response()->json(true);
        
    }
    public function destroy(string $szekrenyId){
        $szekreny=Szekeny::find($szekrenyId);
       
        $szekreny->delete();
        return response()->json(true);
    }
    public function letszam()
    {
        $szekrenyekDb2=Szekeny::selectRaw('count(*) as db, ures_e, tipusa')
            ->groupBy('ures_e')
            ->groupBy('tipusa')
            ->get();
        return response()->json($szekrenyekDb2);
    }
    public function osszesOltozoFeloldas()//g
    {
        Szekeny::where('ures_e', '=', 'F')->update(['ures_e' => 'Ü']);
        return response()->json(true);
    }
    
}
