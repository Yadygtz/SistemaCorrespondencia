<?php

namespace App\Http\Controllers;

use App\Models\ModelCorrepondencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CorrespondenciaController extends Controller
{

    public $area;

    public function index()
    {
        $correspondencia = ModelCorrepondencia::where('area', 'like', '%INFORMATICA%')->get();
        $areas = DB::table('correspondencia')->select('area')->distinct()->orderByRaw('area ASC')->get();
        $areasCB = "";
        foreach ($areas as $area) {
            $areasCB .= "<option value='" . $area->area . "'>" . $area->area . "</option>";
        }

        $areaCB_activo = true;
        $area = "INFORMATICA"; // Area del usuario autenticado.
        return view('correspondencia', compact('correspondencia', 'areasCB', 'areaCB_activo', 'area'));
    }

    public function show($oficio)
    {
        $correspondencia = ModelCorrepondencia::find($oficio);
        return response()->json($correspondencia);
    }

    public function agregar(Request $request){

    }

    public function editar(Request $request, $id){
        // Validación de los datos
        $validatedData = $request->validate([
            'no_oficio' => 'required|string|max:255',
            // Añade las reglas de validación para el resto de los campos
        ]);

        // Encontrar el registro por ID y actualizarlo
        $correspondencia = ModelCorrepondencia::findOrFail($id);
        $correspondencia->update($validatedData);

        // Redireccionar o devolver una respuesta adecuada
        return redirect()->back()->with('success', 'Oficio actualizado correctamente.');
    }

    public function borrar(Request $request){

    }
}
