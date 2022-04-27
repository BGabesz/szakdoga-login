<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berlet_tipus;
use Illuminate\Support\Facades\Schema;
class BerletTipusController extends Controller
{
    
    public function index(Request $request)
    { $sort=$request->query ('_sort');
        $order=$request->query ('_order');
        $q=$request->query('q');
        $berletTipus=Berlet_tipus::selectRaw("*");
        if($sort&&$order){
            $berletTipus->orderBy($sort,$order);
        }
        if($q){
            
            foreach ( Schema::getColumnListing("berlet_tipuses") as $column) {
               // dd(Schema::getColumnType("szemelies",$column));
                $berletTipus->orWhere($column,'like','%'.$q.'%');
                $berletTipus->orWhere($column,$q);
            };
        }
        //$szemelyek= ($sort&&$order) ? Szemely::orderBy($sort,$order)->get(): Szemely::all();
      
       
        //dd($szemelyek->toSql());

        return response()->json($berletTipus->get());
    }
    
    public function store(Request $request){
        $megnevezes=$request->input("megnevezes");
         $idotartam=$request->input("idotartam_nap");
                $ar=$request->input("ar");
 
        $berletTipus=new Berlet_tipus;
        $berletTipus->megnevezes=$megnevezes;
        $berletTipus->idotartam_nap=$idotartam;
        $berletTipus->ar=$ar;
       
        $berletTipus->save();
      

        return response()->json(true);}


    public function update(Request $request,string $berletTipusId)
    {
        $megnevezes=$request->input("megnevezes");
             $idotartam=$request->input("idotartam_nap");
         $ar=$request->input("ar");
 
        $berletTipus=Berlet_tipus::find($berletTipusId);
        $berletTipus->megnevezes=$megnevezes;
        $berletTipus->idotartam_nap=$idotartam;
        $berletTipus->ar=$ar;
       
        $berletTipus->save();
      

        return response()->json(true);
        
    }
    public function destroy(string $berletTipusId){
        $berletTipus=Berlet_tipus::find($berletTipusId);
       
        $berletTipus->delete();
        return response()->json(true);
    }
   
    public function getAr($id)
    {
        dd(Berlet_tipus::find($id)->ara);
    }
}
