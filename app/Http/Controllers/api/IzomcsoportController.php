<?php


namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Izomcsoport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class IzomcsoportController extends Controller
{
    public function index(Request $request)
    { $sort=$request->query ('_sort');
        $order=$request->query ('_order');
        $q=$request->query('q');
        $izomcsoportok=Izomcsoport::selectRaw("*");
        if($sort&&$order){
            $izomcsoportok->orderBy($sort,$order);
        }
        if($q){
            
            foreach ( Schema::getColumnListing("izomcsoports") as $column) {
               // dd(Schema::getColumnType("szemelies",$column));
                $izomcsoportok->orWhere($column,'like','%'.$q.'%');
                $izomcsoportok->orWhere($column,$q);
            };
        }
        //$szemelyek= ($sort&&$order) ? Szemely::orderBy($sort,$order)->get(): Szemely::all();
      
       
        //dd($szemelyek->toSql());

        return response()->json($izomcsoportok->get());
    }
}

