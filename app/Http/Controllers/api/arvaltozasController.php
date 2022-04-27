<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Arvaltozas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class arvaltozasController extends Controller
{
    public function index(Request $request)
    { $sort=$request->query ('_sort');
        $order=$request->query ('_order');
        $q=$request->query('q');
        $arvaltozasok=Arvaltozas::selectRaw("*");
        if($sort&&$order){
            $arvaltozasok->orderBy($sort,$order);
        }
        if($q){
            
            foreach ( Schema::getColumnListing("arvaltozas") as $column) {
               // dd(Schema::getColumnType("szemelies",$column));
                $arvaltozasok->orWhere($column,'like','%'.$q.'%');
                $arvaltozasok->orWhere($column,$q);
            };
        }
        //$szemelyek= ($sort&&$order) ? Szemely::orderBy($sort,$order)->get(): Szemely::all();
      
       
        //dd($szemelyek->toSql());

        return response()->json($arvaltozasok->get());
    }public function store(Request $request){ 
         $Berlet_tipus_id=$request->input("berlet_tipus_id");
        $regi_ar=$request->input("regi_ar");
        $uj_ar=$request->input("uj_ar");
        $mettol=$request->input("mettol");
        $meddig=$request->input("meddig");
       
              $arvaltozas=new Arvaltozas;
              $arvaltozas->berlet_tipus_id=$Berlet_tipus_id;
              $arvaltozas->regi_ar=$regi_ar;
              $arvaltozas->uj_ar=$uj_ar;
              $arvaltozas->mettol=$mettol;
              $arvaltozas->meddig=$meddig;
             
              $arvaltozas->save();
            
      
              return response()->json(true);}
    public function update(Request $request)
    {
  
 
  $original=$request->input('originalInputs');
  $new=$request->input('newInputs');
 DB::Table('arvaltozas')
 ->where([
     ['berlet_tipus_id',$original['berlet_tipus_id']],
     ['regi_ar',$original['regi_ar']],
     ['uj_ar',$original['uj_ar']],
     ['mettol',$original['mettol']],
     ['meddig',$original['meddig']],
 ])
 ->update([
        'berlet_tipus_id'=>$new['berlet_tipus_id'],
        'regi_ar'=>$new['regi_ar'],
        'uj_ar'=>$new['uj_ar'],
        'mettol'=>$new['mettol'],
        'meddig'=>$new['meddig'],
 ]);

 
  return response()->json(true);
}

       
        
    
public function delete(Request $request){
    $original=$request->all();
   
    DB::Table('arvaltozas')
 ->where([
     ['berlet_tipus_id',$original['berlet_tipus_id']],
     ['regi_ar',$original['regi_ar']],
     ['uj_ar',$original['uj_ar']],
     ['mettol',$original['mettol']],
     ['meddig',$original['meddig']],
 ])->delete();
   
    return response()->json(true);
    }
}
