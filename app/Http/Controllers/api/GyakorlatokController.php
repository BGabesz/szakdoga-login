<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Gyakorlat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class gyakorlatokController extends Controller
{
    public function index(Request $request)
    { $sort=$request->query ('_sort');
        $order=$request->query ('_order');
        $q=$request->query('q');
        $gyakorlatok=Gyakorlat::selectRaw("*");
        if($sort&&$order){
            $gyakorlatok->orderBy($sort,$order);
        }
        if($q){
            
            foreach ( Schema::getColumnListing("gyakorlats") as $column) {
               // dd(Schema::getColumnType("szemelies",$column));
                $gyakorlatok->orWhere($column,'like','%'.$q.'%');
                $gyakorlatok->orWhere($column,$q);
            };
        }
        //$szemelyek= ($sort&&$order) ? Szemely::orderBy($sort,$order)->get(): Szemely::all();
      
       
        //dd($szemelyek->toSql());

        return response()->json($gyakorlatok->get());
    } public function store(Request $request){
        $eszkoztipusszamlalo=$request->input("eszkoz_tipus_szamlalo");
        $izomcsopotId=$request->input("izomcsoport_id");
  $megnevezes=$request->input("megnevezes");
  
  $leiras=$request->input("leiras");
  $szint=$request->input("szint");

 
        $gyakorlat=new Gyakorlat;
        $gyakorlat->eszkoz_tipus_szamlalo=$eszkoztipusszamlalo;
        $gyakorlat->izomcsoport_id=$izomcsopotId;
        $gyakorlat->megnevezes=$megnevezes;
        $gyakorlat->video="toábbFejlesztés";
        $gyakorlat->leiras=$leiras;
        $gyakorlat->szint=$szint;
    
        $gyakorlat->save();
      

        return response()->json(true);}
        
        public function update(Request $request)
    {
         

         $original=$request->input('originalInputs');
         $new=$request->input('newInputs');
        DB::Table('gyakorlats')
        ->where([
            ['eszkoz_tipus_szamlalo',$original['eszkoz_tipus_szamlalo']],
            ['izomcsoport_id',$original['izomcsoport_id']],
            ['megnevezes',$original['megnevezes']],
            ['leiras',$original['leiras']],
            ['szint',$original['szint']],
        ])
        ->update([
        'eszkoz_tipus_szamlalo' => $new['eszkoz_tipus_szamlalo'],
        'izomcsoport_id' => $new['izomcsoport_id'],
        'megnevezes' => $new['megnevezes'],
        'leiras' => $new['leiras'],
        'szint' => $new['szint'],
        ]);

 
  return response()->json(true);
        
    }
    public function delete(Request $request){
        $original=$request->all();
       
        DB::Table('gyakorlats')
        ->where([
            ['eszkoz_tipus_szamlalo',$original['eszkoz_tipus_szamlalo']],
            ['izomcsoport_id',$original['izomcsoport_id']],
            ['megnevezes',$original['megnevezes']],
            ['leiras',$original['leiras']],
            ['szint',$original['szint']],
        ])->delete();
       
        return response()->json(true);
    }
}
