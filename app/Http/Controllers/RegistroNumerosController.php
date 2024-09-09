<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\RegistroNumeros;
use Illuminate\Support\Facades\Storage;

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

         // Convertir las fechas de Y-m-d a d/m/Y
         if (isset($validatedData['fecha'])) {
            $validatedData['fecha'] = Carbon::createFromFormat('Y-m-d', $validatedData['fecha'])->format('d/m/Y');

        }

        // Encontrar el registro por ID y actualizarlo
        $reg = RegistroNumeros::where('numeroId','=',$id)->first();
        $reg->update($validatedData);

        $directorio = $request->numeroId;
        $ruta = '/Acuses/'. $directorio;
        try {
            // Verificar si hay un archivo en la solicitud
            if ($request->hasFile('oficioAnexo')) {
                if(!Storage::disk('ftp')->exists($ruta))
                {

                    Storage::disk('ftp')->makeDirectory($ruta);
                }
                    $archivoPDF = $request->file('oficioAnexo');
                    $nombrearchivo = $archivoPDF->getClientOriginalName(); // No es necesario añadir ".pdf" ya que ya está en el nombre
                    // Ruta donde se guardará el archivo
                    $path = "/Acuses/" .  $directorio . '/' . $nombrearchivo;

                    // Guardar el archivo en la carpeta especificada
                    Storage::disk('ftp')->put($path, file_get_contents($archivoPDF));

                }
                else
                {
                    // Mensaje de que no se subió el archivo
                    return redirect()->back()->with('success', 'Oficio actualizado pero no se subió ningún archivo.');
                }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

        // $validatedData["modificado_por"]  = auth()->user()->id;
        // Redireccionar o devolver una respuesta adecuada
        return redirect()->back()->with('success', 'Oficio actualizado correctamente.');

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
        $n = '';

        if($request->nfolios >1)
        {
            $folconsec = intval($request->numeroId) + intval($request->nfolios - 1);
            $n = $request->numeroId.'-'.$folconsec;

        }else{
            $n = $request->numeroId;
        }

        // Crear el Oficio
        RegistroNumeros::create([
            'numeroId' => $n,
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

    public function listfiles($numeroId){

        $rutaCarpeta = "Acuses/" . $numeroId . "/";
            if (Storage::disk('ftp')->exists($rutaCarpeta)) {

                $files = Storage::disk('ftp')->files($rutaCarpeta);
                $fileName = [];
                foreach($files as $file){
                    $fileName[] = basename($file);
                }
                return response()->json($fileName);
            } else {
                return response()->json(["success"=>false]);
            }
    }


}
