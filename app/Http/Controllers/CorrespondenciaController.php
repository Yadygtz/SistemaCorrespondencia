<?php

namespace App\Http\Controllers;

use App\Models\ModelCorrepondencia;
use Illuminate\Http\Request;

class CorrespondenciaController extends Controller
{

    public function index()
    {
        $correspondencia = ModelCorrepondencia::where('area', 'like', '%INFORMATICA%')->get();
        return view('correspondencia', compact('correspondencia'));
    }

    public function show($oficio)
    {
        $correspondencia = ModelCorrepondencia::find($oficio);
        return response()->json($correspondencia);
    }
}
