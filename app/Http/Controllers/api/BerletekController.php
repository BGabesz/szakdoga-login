<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berlet;
use App\Models\Berlet_tipus;
use DateTime;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class BerletekController extends Controller
{
    public function index(Request $request)
    { $sort=$request->query ('_sort');
        $order=$request->query ('_order');
        $q=$request->query('q');
        $berletek=Berlet::selectRaw("*");
        if($sort&&$order){
            $berletek->orderBy($sort,$order);
        }
        if($q){
            
            foreach ( Schema::getColumnListing("berlets") as $column) {
               // dd(Schema::getColumnType("szemelies",$column));
                $berletek->orWhere($column,'like','%'.$q.'%');
                $berletek->orWhere($column,$q);
            };
        }
        //$szemelyek= ($sort&&$order) ? Szemely::orderBy($sort,$order)->get(): Szemely::all();
      
       
        //dd($szemelyek->toSql());

        return response()->json($berletek->get());
    }public function store(Request $request){
        $Berlet_tipus_id=$request->input("Berlet_tipus_id");
        $ugyfel=$request->input("ugyfel");
        $datum_tol=$request->input("datum_tol");
        $datum_ig=$request->input("datum_ig");
       
              $Berlet_tipus=new Berlet;
              $Berlet_tipus->Berlet_tipus_id=$Berlet_tipus_id;
              $Berlet_tipus->ugyfel=$ugyfel;
              $Berlet_tipus->datum_tol=$datum_tol;
              $Berlet_tipus->datum_ig=$datum_ig;
             
              $Berlet_tipus->save();
            
      
              return response()->json(true);
    }      
    public function update(Request $request)
    {

  $original=$request->input('originalInputs');
  $new=$request->input('newInputs');
  $datumig=Berlet_tipus::find($new['berlet_tipus_id']);
  $alapDatum=new DateTime($new['datum_tol']);
  $datum=date_add($alapDatum, date_interval_create_from_date_string($datumig->idotartam_nap.' days'));
 DB::Table('berlets')
 ->where([
     ['berlet_tipus_id',$original['berlet_tipus_id']],
     ['ugyfel',$original['ugyfel']],
     ['datum_tol',$original['datum_tol']],
     ['datum_ig',$original['datum_ig']],
 ])
 ->update([
 'berlet_tipus_id' => $new['berlet_tipus_id'],
 'ugyfel' => $new['ugyfel'],
 'datum_tol' => $new['datum_tol'],
 'datum_ig' =>$datum->format('Y-m-d H:i:s')  ,
 ]);

 
  return response()->json(true);

    }
    public function delete(Request $request){
        $original=$request->all();
       
        DB::Table('berlets')->where([
     ['berlet_tipus_id',$original['berlet_tipus_id']],
     ['ugyfel',$original['ugyfel']],
     ['datum_tol',$original['datum_tol']],
     ['datum_ig',$original['datum_ig']],
        ])->delete();
       
        return response()->json(true);
    }
       
    
   
}
