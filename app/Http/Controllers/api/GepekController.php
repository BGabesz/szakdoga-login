<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Eszkoz_tipus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GepekController extends Controller
{
    /*Minden vissza ad json-ba*/
    public function index(Request $request)
    {
        $sort = $request->query('_sort');
        $order = $request->query('_order');
        $q = $request->query('q');
        $eszkoztipusok = Eszkoz_tipus::selectRaw("*");
        if ($sort && $order) {
            $eszkoztipusok->orderBy($sort, $order);
        }
        if ($q) {

            foreach (Schema::getColumnListing("eszkoz_tipuses") as $column) {
                // dd(Schema::getColumnType("szemelies",$column));
                $eszkoztipusok->orWhere($column, 'like', '%' . $q . '%');
                $eszkoztipusok->orWhere($column, $q);
            };
        }
        //$szemelyek= ($sort&&$order) ? Szemely::orderBy($sort,$order)->get(): Szemely::all();


        //dd($szemelyek->toSql());

        return response()->json($eszkoztipusok->get());
    }
    public function store(Request $request)
    {
        $eszkozNeve = $request->input("eszkoz_neve");
        $suly = $request->input("suly");
        $leiras = $request->input("leiras");

        $eszkoz = new Eszkoz_tipus;
        $eszkoz->eszkoz_neve = $eszkozNeve;
        $eszkoz->suly = $suly;
        $eszkoz->leiras = $leiras;

        $eszkoz->save();


        return response()->json(true);
    }
    public function update(Request $request, string $eszkozTipusId)
    {
        $eszkozNeve = $request->input("eszkoz_neve");
        $suly = $request->input("suly");
        $leiras = $request->input("leiras");

        $eszkozTipus = Eszkoz_tipus::find($eszkozTipusId);
        $eszkozTipus->eszkoz_neve = $eszkozNeve;
        $eszkozTipus->suly = $suly;
        $eszkozTipus->leiras = $leiras;

        $eszkozTipus->save();


        return response()->json(true);
    }
    public function destroy(string $eszkozTipusId)
    {
        $eszkozTipus = Eszkoz_tipus::find($eszkozTipusId);

        $eszkozTipus->delete();
        return response()->json(true);
    }
}
