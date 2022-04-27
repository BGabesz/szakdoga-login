<?php

use App\Http\Controllers\api\arvaltozasController;
use App\Http\Controllers\api\BerletTipusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\GepekController;
use App\Http\Controllers\api\EdzesekController;
use App\Http\Controllers\api\EszkozController;
use App\Http\Controllers\api\gyakorlatokController;
use App\Http\Controllers\api\MunkaidoController;
use App\Http\Controllers\api\OltozofoglalasokController;
use App\Http\Controllers\api\SzekrenyekController;
use App\Http\Controllers\api\SzemelyController;
use App\Http\Controllers\api\TermekController;
use App\Http\Controllers\api\EdzoIdopontokController;
use App\Http\Controllers\api\IzomcsoportController;
use App\Http\Controllers\api\jogosultsagController;
use App\Http\Controllers\api\BerletekController;

use App\Http\Controllers\api\szemelyLekerdezController;
use App\Http\Controllers\api\UgyfeledzesFelviszController;
//ügyfél edzés controller meghívása
use App\Http\Controllers\api\UgyfelEdzesController;
//Recepció oldalhoz
use App\Http\Controllers\api\szekrenyListazController;
use App\Http\Controllers\FileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('gepek', GepekController::class);
Route::apiResource('berletTipus', BerletTipusController::class);
Route::get("szemely/ugyfelek",[SzemelyController::class,'ugyfelek']);
Route::get("szemely/edzok",[SzemelyController::class,'edzok']);
Route::get("szemely/dolgozok",[SzemelyController::class,'dolgozok']);
Route::apiResource('szemely', SzemelyController::class);
Route::apiResource('eszkoz', EszkozController::class);
Route::apiResource('edzesek', EdzesekController::class);
Route::post('edzesek/delete', [EdzesekController::class,"delete"]);
Route::apiResource('gyakorlat', gyakorlatokController::class);
Route::post('gyakorlat/delete', [gyakorlatokController::class,"delete"]);
Route::apiResource('munkaido', MunkaidoController::class);
Route::post('munkaido/delete', [MunkaidoController::class,"delete"]);
Route::get("oltozofoglalas/letszam/napi",[OltozofoglalasokController::class,"letszamNaponta"]);
Route::apiResource('oltozofoglalas', OltozofoglalasokController::class);
Route::apiResource('szekreny', SzekrenyekController::class);
Route::apiResource('terem', TermekController::class);
Route::apiResource('izomcsoport', IzomcsoportController::class);
Route::apiResource('jogosultsag', jogosultsagController::class);
Route::get("proba",[BerletTipusController::class,"getAr"]);
Route::apiResource('edzoIdopont', EdzoIdopontokController::class);
Route::apiResource('berletek', BerletekController::class);
Route::post('berletek/delete', [BerletekController::class,"delete"]);
Route::apiResource('arvaltozas', arvaltozasController::class);
Route::post('arvaltozas/delete', [arvaltozasController::class,"delete"]);



//---------------------------------------------------------------------------------------------
//Recepció oldalhoz
/* Route::apiResource('szekreny', SzekrenyekController::class); */
Route::post('/szekrenyOsszesFelold', [SzekrenyekController::class, 'osszesOltozoFeloldas']);
Route::get('/szekrenyLetszam', [SzekrenyekController::class, 'letszam']);
//feltolt kep, igazolvany
Route::post('feltoltes', [SzemelyController::class, 'feltoltKepIgazolvany']);
//web ben van az öltözőfoglalás felvitel
/* Route::apiResource('ugyfelEdzesSzemellyel', ugyfelEdzesSzemellyel::class); */
Route::apiResource('szemelyLekerdezes', szemelyLekerdezController::class);
//---------------------------------------------------------------------------------------------
//Edző oldalhoz
//Route::apiResource('ugyfelEdzes', UgyfelEdzesController::class);
Route::post('/ugyfelEdzes/delete', [UgyfelEdzesController::class, 'delete']);//feloldja az adott ugyfeledzes foglalast
Route::post('/ugyfelEdzes/update', [UgyfelEdzesController::class, 'update']);//friisiti,modositja az adott ugyfeledzes foglalast
//ügyfél edzés szűrés
/* Route::get("szemely",[SzemelyController::class,'index']); //szemely?nev=*/
//---------------------------------------------------------------------------------------------
