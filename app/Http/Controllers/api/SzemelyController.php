<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Berlet;
use App\Models\Edzotorles;
use App\Models\Jogosultsag;
use App\Models\Munkaido;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ugyfel_edzes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class SzemelyController extends Controller
{
    public function index(Request $request){ 
        $sort=$request->query ('_sort');
        $order=$request->query ('_order');
        $q=$request->query('q');
        $nev=$request->query('nev');
        $szemelyek=User::selectRaw("*");
        if($sort&&$order){
            $szemelyek->orderBy($sort,$order);
        }
        if($q){
            
            foreach ( Schema::getColumnListing("users") as $column) {
               // dd(Schema::getColumnType("szemelies",$column));
                $szemelyek->orWhere($column,'like','%'.$q.'%');
                $szemelyek->orWhere($column,$q);
            };
        }
        if($nev){
            $szemelyek->where('name','like','%'.$nev.'%');
        }
        //$szemelyek= ($sort&&$order) ? Szemely::orderBy($sort,$order)->get(): Szemely::all();
      
       
        //dd($szemelyek->toSql());

        return response()->json($szemelyek->get());
    } public function store(Request $request){
        $emailCim=$request->input("email_cim");
        $nev=$request->input("nev");
        $szulDatum=$request->input("szul_datum");
        $neme=$request->input("neme");
        $igazolvanySzam=$request->input("igazolvany_szam");
        $igazolvanyTipusa=$request->input("igazolvany_tipusa");
        $tel_szam=$request->input("tel_szam");
        $kep="alap";
       // $telSzam=$request->input("tel_szam");
       // $kep=$request->input("kep");
        $jogosultsagId=$request->input("jogosultsag_id");
        $szemely=new User;
        $szemely->jogosultsag_id=$jogosultsagId;
        $szemely->email=$emailCim;
        $szemely->jelszo=Hash::make($igazolvanySzam);
        $szemely->name=$nev;
        $szemely->szul_datum=$szulDatum;
        $szemely->neme=$neme;
        $szemely->igazolvany_szam=$igazolvanySzam;
        $szemely->igazolvany_tipusa=$igazolvanyTipusa;
        $szemely->tel_szam=$tel_szam;
        $szemely->kep=$kep;
       // $szemely->tel_szam=$telSzam;
        //$szemely->kep=$kep;
        $szemely->save();
    }
    public function update(Request $request,string $szemelyId){
        $emailCim=$request->input("email_cim");
        $nev=$request->input("nev");
        $szulDatum=$request->input("szul_datum");
        $neme=$request->input("neme");
        $igazolvanySzam=$request->input("igazolvany_szam");
        $igazolvanyTipusa=$request->input("igazolvany_tipusa");
        // $telSzam=$request->input("tel_szam");
        $jogosultsagId=$request->input("jogosultsag_id");

 
        $szemely=User::find($szemelyId);
        $szemely->jogosultsag_id=$jogosultsagId;
        $szemely->email=$emailCim;
        $szemely->name=$nev;
        $szemely->szul_datum=$szulDatum;
        $szemely->neme=$neme;
        $szemely->igazolvany_szam=$igazolvanySzam;
        $szemely->igazolvany_tipusa=$igazolvanyTipusa;
       // $szemely->tel_szam=$telSzam;
        //$szemely->kep=$kep;
        $szemely->save();

        return response()->json(true);
        
    }
    public function destroy(string $szemelyId){
        $szemely=User::find($szemelyId);
        $szemely->delete();
       
        
        return response()->json(true);
    }
    public function ugyfelek(){
        $szemelyek=User::where('jogosultsag_id',1)->get();
        return response()->json($szemelyek);
    }
    public function edzok(){
        $szemelyek=User::where('jogosultsag_id',3)->get();
        return response()->json($szemelyek);
    }
    public function dolgozok(){
        $szemelyek=User::where('jogosultsag_id',2)->get();
        return response()->json($szemelyek);
    }
    function feltoltKepIgazolvany(Request $request){
        $szemely=User::find($request->input('szemely_id'));
        $kep=$request->file("image")->getClientOriginalName();//file(ide kell irni a kép nevét)->getClientOriginalName()megkapjuk a file nevét pl kep1.png
        $szemely->igazolvany_szam=$request->input('igazolvany_szam');
        $szemely->igazolvany_tipusa=$request->input('igazolvany_tipusa');
        
  
        $datum=Carbon::now();
        $datum=$datum->format('Y-m-d\TH.i.s');
        $kepEgyedi= $datum.$kep;
        $szemely->kep=$kepEgyedi;
        $request->image->move(public_path('kepek/SzemelyKepek'),$kepEgyedi);//hova töltse fel milyen névvel fontos hogy egyedi legyen
        $szemely->save();
        return ['result'=>'Sikeres Feltöltés'];/* ->input('details')->all() */
     }

}
