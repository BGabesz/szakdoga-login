<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\EszkozView;
use App\Models\Eszkoz;
use App\Models\Eszkoz_tipus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

class EszkozController extends Controller
{


    public function index(Request $request) {
        $sort = $request->query('_sort');
        $order = $request->query('_order');
        $q = $request->query('q');
        $eszkozok = EszkozView::selectRaw("*");
        if ($sort && $order) {
            $eszkozok->orderBy($sort, $order);
        }
        if ($q) {

            foreach (Schema::getColumnListing("Vieweszkoz") as $column) {
                // dd(Schema::getColumnType("szemelies",$column));
                $eszkozok->orWhere($column, 'like', '%' . $q . '%');
                $eszkozok->orWhere($column, $q);
            };
        }
      


       

        return response()->json($eszkozok->get());
    }
    public function store(Request $request) {
        $eszkozNeve = $request->input("eszkoz_neve");
        $teremId = $request->input("terem_id");
        $eszkozTipusSzamlalo = Eszkoz_tipus::firstWhere("eszkoz_neve", $eszkozNeve)->eszkoz_tipus_szamlalo;

        $eszkoz = new Eszkoz;
        $eszkoz->terem_id = $teremId;
        $eszkoz->eszkoz_tipus_szamlalo = $eszkozTipusSzamlalo;
        $eszkoz->qr_kod = "null";
        $eszkoz->save();


        return response()->json(true);
    }
    public function update(Request $request, string $eszkozId) {
        $eszkozNeve = $request->input("eszkoz_neve");
        $teremId = $request->input("terem_id");
        $eszkozTipusSzamlalo = Eszkoz_tipus::firstWhere("eszkoz_neve", $eszkozNeve)->eszkoz_tipus_szamlalo;

        $eszkoz = Eszkoz::find($eszkozId);
        $eszkoz->terem_id = $teremId;
        $eszkoz->eszkoz_tipus_szamlalo = $eszkozTipusSzamlalo;
        $eszkoz->save();


        return response()->json(true);
    }
    public function destroy(string $eszkozId) {
        $eszkoz = Eszkoz::find($eszkozId);

        $eszkoz->delete();
        return response()->json(true);
    }
    public function eszkozok(){
        

    }
}
