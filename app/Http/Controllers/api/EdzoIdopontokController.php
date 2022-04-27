<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Edzo_idopont;


class EdzoIdopontokController extends Controller
{
    public function index()
    {
        return response()->json(Edzo_idopont::all());
    }
}
