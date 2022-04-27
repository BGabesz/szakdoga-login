<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\GepekController;
use App\Http\Controllers\CostumAuthController;
use App\Http\Controllers\api\EszkozDbController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UgyfeledzesFelviszController;
use App\Http\Controllers\api\OltozofoglalasokController;
use App\Http\Controllers\szekrenyListazController;
use App\Http\Middleware\FelhasznaloJogosultsag;
use App\Http\Controllers\api\UgyfelEdzesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



Route::get('/', [IndexController::class ,'index'  ]);
Route::get('/gepek', function () { return view('pages.gepek'); });
Route::get('/kapcsolatok', function () { return view('pages.kapcsolatok'); });
Route::get('/vasarlas', function () { return view('pages.vasarlas'); });
Route::get('/cikkek_etrend', function () { return view('pages.cikkek_etrend'); });
Route::get('/bejelentkezes', function () { return view('pages.bejelentkezes'); });
Route::get('/regisztracio', function () { return view('pages.regisztracio'); });
    Route::get('/admin', function () { return view('pages.admin'); })->middleware(['auth']);
Route::get("eszkozDB",[EszkozDbController::class,"show"]);
Route::get('/chart',function(){return view('pages.admin.chart');});
Route::get('/adminTeszt',function(){return view('pages.admin.test.adminTest');});
    Route::get('/edzo', function () { return view('pages.edzo'); })->middleware(['auth']);
    Route::get('/recepcio', function () { return view('pages.recepcio'); })->middleware(['auth']);
    Route::get('/berletVasarlas', function () { return view('pages.berletVasarlas');})->middleware(['auth']);


Route::get('/api/gepek/search', [GepekController::class, 'search']);
Route::get('/api/gepek/sort', [GepekController::class, 'sortBy']);
Route::get('/api/gepek/{id}', [GepekController::class, 'show']);

//---------------------------------------------------------------------------------------------
// Ugyfel edzes foglalas felvitele ,felviszUgyfelFoglalas ,//üzenetet ad vissza(sikeres,vagy sem)
Route::post('/ugyfelEdzesFoglalasFelvitel', [UgyfeledzesFelviszController::class, 'felviszUgyfelFoglalas'] )->name('ugyfelEdzesFoglalasFelvitel1');
//---------------------------------------------------------------------------------------------
//oltozo foglalas felvitele szemelyel ,ellenorzi üres e a szekrény,van e bérlete, létezik e a személy //üzenetet ad vissza
Route::post('/OltozoFoglalasFelvitel', [OltozofoglalasokController::class, 'OltozoFoglalas'] )->name('OltozoFoglalasFelvitel');
//---------------------------------------------------------------------------------------------

Route::get('/feltoltOldal', function () { return view('pages.feltolt'); });

//Edző oldalhoz
Route::get('/ugyfelEdzes', [UgyfelEdzesController::class, 'index']);//adatokat megjeleniti 