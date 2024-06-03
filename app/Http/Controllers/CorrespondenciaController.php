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

    public function agregar(Request $request)
    {
        // Validacion de los datos
        $request->validate([
            'no_oficio' => 'required|string|max:255|min:5',
        ]);

        // Crear el Oficio
        ModelCorrepondencia::create([
            'no_oficio' => $request->no_oficio,
            'fecha_oficio' => $request->fecha_oficio,
            'enviado_por' => $request->enviado_por,
            'asunto' => $request->asunto,
            'area' => $request->areaCB,
            'folder' => $request->folder,
            'recibido_por' => $request->recibido_por,
            'fecha_recibido' => $request->fecha_recibido,
            'creado_por' => auth()->user()->id,
        ]);

        // Redireccionar o devolver una respuesta adecuada
        return redirect()->back()->with('success', 'Oficio creado correctamente.');
    }

    public function editar(Request $request, $id)
    {
        // Validación de los datos
        $validatedData = $request->validate([
            'no_oficio' => 'required|string|max:255',
            // Añade las reglas de validación para el resto de los campos
        ]);

        $validatedData["modificado_por"]  = auth()->user()->id;

        // Encontrar el registro por ID y actualizarlo
        $correspondencia = ModelCorrepondencia::findOrFail($id);
        $correspondencia->update($validatedData);

        // Redireccionar o devolver una respuesta adecuada
        return redirect()->back()->with('success', 'Oficio actualizado correctamente.');
    }

    public function borrar(Request $request)
    {
    }
}
