<?php

namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Edzesek;
use App\Models\Ugyfel_edzes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class EdzesekController extends Controller
{
    public function index(Request $request)
    { $sort=$request->query ('_sort');
        $order=$request->query ('_order');
        $q=$request->query('q');
        $edzesek=Edzesek::selectRaw("*");
        if($sort&&$order){
            $edzesek->orderBy($sort,$order);
        }
        if($q){
            
            foreach ( Schema::getColumnListing("ugyfel_edzes") as $column) {
               // dd(Schema::getColumnType("szemelies",$column));
                $edzesek->orWhere($column,'like','%'.$q.'%');
                $edzesek->orWhere($column,$q);
            };
        }
        //$szemelyek= ($sort&&$order) ? Szemely::orderBy($sort,$order)->get(): Szemely::all();
      
       
        //dd($szemelyek->toSql());
    $edzesek=$edzesek->get();
        return response()->json($edzesek);
        

    }public function update(Request $request){
        $original=$request->input('originalInputs');
        $new=$request->input('newInputs');
       DB::Table('ugyfel_edzes')
       ->where([
           ['edzo',$original['edzo']],
           ['ugyfel',$original['ugyfel']],
           ['datum',$original['datum']],
           ['ora',$original['ora']],
       ])
       ->update([
       'edzo' => $new['edzo'],
       'ugyfel' => $new['ugyfel'],
       'datum' => $new['datum'],
       'ora' => $new['ora'],
       ]);

       
        return response()->json(true);
    }
    public function delete(Request $request){
        $original=$request->all();
       
        DB::Table('ugyfel_edzes')
       ->where([
           ['edzo',$original['edzo']],
           ['ugyfel',$original['ugyfel']],
           ['datum',$original['datum']],
           ['ora',$original['ora']],
       ])->delete();
       
        return response()->json(true);
     }
    
}
