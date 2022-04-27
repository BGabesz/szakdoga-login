<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Terem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
class TermekController extends Controller
{
    public function index(Request $request)
    { $sort=$request->query ('_sort');
        $order=$request->query ('_order');
        $q=$request->query('q');
        $termek=Terem::selectRaw("*");
        if($sort&&$order){
            $termek->orderBy($sort,$order);
        }
        if($q){
            
            foreach ( Schema::getColumnListing("terems") as $column) {
               // dd(Schema::getColumnType("szemelies",$column));
                $termek->orWhere($column,'like','%'.$q.'%');
                $termek->orWhere($column,$q);
            };
        }
        //$szemelyek= ($sort&&$order) ? Szemely::orderBy($sort,$order)->get(): Szemely::all();
      
       
        //dd($szemelyek->toSql());

        return response()->json($termek->get());
    }
}
