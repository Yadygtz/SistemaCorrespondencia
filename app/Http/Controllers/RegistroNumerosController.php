<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\RegistroNumeros;

class RegistroNumerosController extends Controller
{
    //
    public function index()
    {
        
        //$RegNumeros = RegistroNumeros::take(30)->get();
        //$noficio =  DB::table('registro_numeros')->select('numeroId')->get();
        $areas = ['INTEGRACIÓN','ADMINISTRATIVO','COORDINACIÓN','JURÍDICO','PROGRAMACIÓN','INFORMÁTICA','ANTECEDENTES','PLANEACIÓN E INNOVACIÓN','SOCIOECONÓMICO','PSICOLOGÍA','LIBRE','VALIDACIÓN'];
        $areasCB = '';
        foreach ($areas as $area) {
            $areasCB .= "<option value='" . $area . "'>" . $area . "</option>";
        }

        return view('RegistroNumeros', compact('areasCB'));
    }   

    public function ultimoId()
    {
        
        $last = RegistroNumeros::latest('id')->first();
      
        return response()->json($last);
    } 

    public function editar(Request $request, $id)
    {
        // Validación de los datos
        $validatedData = $request->validate([
            'numeroId' => 'required|string|max:255',
            'fecha' => 'string|max:255',
            'area' =>  'string|max:255',
            'asunto' => 'string|max:255',
            'solicita' => 'string|max:255',
            'observaciones' => 'max:255'
            // Añade las reglas de validación para el resto de los campos
            // 'oficioPDF' => 'file|mimes:pdf',
        ]);

        // $validatedData["modificado_por"]  = auth()->user()->id;

        // Convertir las fechas de Y-m-d a d/m/Y
        if (isset($validatedData['fecha'])) {
            $validatedData['fecha'] = Carbon::createFromFormat('Y-m-d', $validatedData['fecha'])->format('d/m/Y');
            
        }

        // Encontrar el registro por ID y actualizarlo
        $reg = RegistroNumeros::where('numeroId','=',$id)->first();
        
        $reg->update($validatedData);

        
        // Redireccionar o devolver una respuesta adecuada
        return redirect()->back()->with('success', 'Registro actualizado correctamente.');

    }

    public function show($id)
    {
       
        $reg = RegistroNumeros::where('numeroId','=',$id)->first();
       
        return response()->json($reg);
    }

    public function agregar(Request $request)
    {
       
        // Validacion de los datos
        $request->validate([
            'numeroId' => 'required|string|max:255',
        ]);

        $folconsec = '';
        if($request->nfolios >1)
        {
            $folconsec = intval($request->numeroId) + intval($request->nfolios - 1);
           // console.log("entro");
        }

        // Crear el Oficio
        RegistroNumeros::create([
            'numeroId' => $request->numeroId.'-'.$folconsec,
            'fecha' => Carbon::createFromFormat('Y-m-d', $request->fecha)->format('d/m/Y'),
            'area' => $request->area,
            'asunto' => $request->asunto,
            'solicita' => $request->solicita,
            'observaciones' => $request->observaciones
        ]);

        // Redireccionar o devolver una respuesta adecuada
        return redirect()->back()->with('success', 'Registro creado correctamente.');
    }

    public function datanumeros(){
        $data = RegistroNumeros::get();
        return response()->json($data);
       
    }


}
