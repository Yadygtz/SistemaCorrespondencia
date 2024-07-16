<?php

namespace App\Http\Controllers;

use App\Models\ModelCorrepondencia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CorrespondenciaController extends Controller
{
    public $area;

    public function index()
    {

        $areas = DB::table('correspondencia')->select('area')->distinct()->orderByRaw('area ASC')->get();
        $areasCB = "";
        foreach ($areas as $area) {
            $areasCB .= "<option value='" . $area->area . "'>" . $area->area . "</option>";
        }

        $areaCB_activo = true;
        $area = auth()->user()->area; // Area del usuario autenticado.

        // $files = Storage::disk('ftp')->allFiles("Oficios/");

        return view('correspondencia', compact('areasCB', 'areaCB_activo', 'area'));
    }

    public function show($oficio)
    {
        $correspondencia = ModelCorrepondencia::find($oficio);
        // Buscar si tiene oficio
        $oficio = $correspondencia->no_oficio;
        $rutaCompletaFTP = "Oficios/" . $oficio . ".pdf";
        if (Storage::disk('ftp')->exists($rutaCompletaFTP)) {
            $correspondencia["tieneOficio"] = "SI";
        } else {
            $correspondencia["tieneOficio"] = "NO";
        }

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
            'fecha_oficio' => Carbon::createFromFormat('Y-m-d', $request->fecha_oficio)->format('d/m/Y'),
            'enviado_por' => $request->enviado_por,
            'asunto' => $request->asunto,
            'area' => $request->areaCB,
            'folder' => $request->observaciones,
            'recibido_por' => $request->anexos,
            'fecha_recibido' =>  Carbon::createFromFormat('Y-m-d', $request->fecha_recibido)->format('d/m/Y'),
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
            'fecha_oficio' => 'string|max:255',
            'enviado_por' =>  'string|max:255',
            'asunto' => 'string|max:255',
            'fecha_recibido' => 'string|max:255',
            'area'  => 'string|max:255'



            // Añade las reglas de validación para el resto de los campos
            // 'oficioPDF' => 'file|mimes:pdf',
        ]);

        $validatedData["modificado_por"]  = auth()->user()->id;
        $validatedData["folder"] = $request->observaciones;
        $validatedData["recibido_por"] = $request->anexos;


        // Convertir las fechas de Y-m-d a d/m/Y
        if (isset($validatedData['fecha_oficio'])) {
            $validatedData['fecha_oficio'] = Carbon::createFromFormat('Y-m-d', $validatedData['fecha_oficio'])->format('d/m/Y');
        }

        if (isset($validatedData['fecha_recibido'])) {
            $validatedData['fecha_recibido'] = Carbon::createFromFormat('Y-m-d', $validatedData['fecha_recibido'])->format('d/m/Y');
        }

        // Encontrar el registro por ID y actualizarlo
        $correspondencia = ModelCorrepondencia::findOrFail($id);
        $correspondencia->update($validatedData);

        if ($request->hasFile('oficioPDF')) {
        try {
            // Verificar si hay un archivo en la solicitud
            if ($request->hasFile('oficioPDF')) {
                $archivoPDF = $request->file('oficioPDF');
                $nombrearchivo = $archivoPDF->getClientOriginalName(); // No es necesario añadir ".pdf" ya que ya está en el nombre

                // Guardar el archivo en el FTP
                $archivoPDF->storeAs(
                    "/Oficios/",
                    $nombrearchivo,
                    'ftp'
                );

            } else {
                // Mensaje de que no se subió el archivo
                return redirect()->back()->with('success', 'Oficio actualizado pero no se subió ningún archivo.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
        }
        // Redireccionar o devolver una respuesta adecuada
        return redirect()->back()->with('success', 'Oficio actualizado correctamente.');

    }

    public function borrar(Request $request)
    {
    }

    public function cargarOficioPDF()
    {
    }

    public function dataoficios(){
        $data = ModelCorrepondencia::where('area', 'like', '%' . auth()->user()->area . '%')->get();
        return response()->json($data);

    }
}
