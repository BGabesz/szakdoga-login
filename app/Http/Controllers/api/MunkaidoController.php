<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Munkaido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class MunkaidoController extends Controller
{
    public function index(Request $request)
    { $sort=$request->query ('_sort');
        $order=$request->query ('_order');
        $q=$request->query('q');
        $munkaidok=Munkaido::selectRaw("*");
        if($sort&&$order){
            $munkaidok->orderBy($sort,$order);
        }
        if($q){
            
            foreach ( Schema::getColumnListing("munkaidos") as $column) {
               // dd(Schema::getColumnType("szemelies",$column));
                $munkaidok->orWhere($column,'like','%'.$q.'%');
                $munkaidok->orWhere($column,$q);
            };
        }
        //$szemelyek= ($sort&&$order) ? Szemely::orderBy($sort,$order)->get(): Szemely::all();
      
       
        //dd($szemelyek->toSql());

        return response()->json($munkaidok->get());
    }public function store(Request $request){
        $dolgozo=$request->input("dolgozo");
  $mettol=$request->input("mettol");
  $meddig=$request->input("meddig");

 
        $munkaido=new Munkaido;
        $munkaido->dolgozo=$dolgozo;
        $munkaido->mettol=$mettol;
        $munkaido->meddig=$meddig;
        $munkaido->save();
        
      

        return response()->json(true);}
    public function update(Request $request)
    {         $original=$request->input('originalInputs');
              $new=$request->input('newInputs');
             DB::Table('munkaidos')
             ->where([
                 ['dolgozo',$original['dolgozo']],
                 ['mettol',$original['mettol']],
                 ['meddig',$original['meddig']],
                
             ])
             ->update([
             'dolgozo' => $new['dolgozo'],
             'mettol' => $new['mettol'],
             'meddig' => $new['meddig'],
             
             ]);
        return response()->json(true);
        
    }
    public function delete(Request $request){
        $original=$request->all();
       
        DB::Table('munkaidos')
             ->where([
                 ['dolgozo',$original['dolgozo']],
                 ['mettol',$original['mettol']],
                 ['meddig',$original['meddig']],
                
             ])->delete();
       
        return response()->json(true);
    }
}
