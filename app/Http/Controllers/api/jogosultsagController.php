<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Jogosultsag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class jogosultsagController extends Controller
{
    public function index(Request $request)
    { $sort=$request->query ('_sort');
        $order=$request->query ('_order');
        $q=$request->query('q');
        $jogosultsagok=Jogosultsag::selectRaw("*");
        if($sort&&$order){
            $jogosultsagok->orderBy($sort,$order);
        }
        if($q){
            
            foreach ( Schema::getColumnListing("jogusultsags") as $column) {
               // dd(Schema::getColumnType("szemelies",$column));
                $jogosultsagok->orWhere($column,'like','%'.$q.'%');
                $jogosultsagok->orWhere($column,$q);
            };
        }
        //$szemelyek= ($sort&&$order) ? Szemely::orderBy($sort,$order)->get(): Szemely::all();
      
       
        //dd($szemelyek->toSql());

        return response()->json($jogosultsagok->get());
    }
    
}
