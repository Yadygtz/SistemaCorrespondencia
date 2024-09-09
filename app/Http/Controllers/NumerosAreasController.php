<?php

namespace App\Http\Controllers;

use App\Models\NumerosAreas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NumerosAreasController extends Controller
{
    public function index()
    {

        //$RegNumeros = RegistroNumeros::take(30)->get();
        //$noficio =  DB::table('registro_numeros')->select('numeroId')->get();
        $areas = ['INTEGRACIÓN','ADMINISTRATIVO','COORDINACIÓN','JURÍDICO','PROGRAMACIÓN','INFORMÁTICA','ANTECEDENTES','PLANEACIÓN E INNOVACIÓN','SOCIOECONÓMICO','PSICOLOGÍA','LIBRE','VALIDACIÓN'];
        $areasCB = '';
        foreach ($areas as $area) {
            $areasCB .= "<option value='" . $area . "'>" . $area . "</option>";
        }

        return view('NumerosAreas', compact('areasCB'));
    }

    public function ultimoId()
    {
        $last = NumerosAreas::where('id_area', 'like', '%' . auth()->user()->area. '%')->latest('id')->first();

        return response()->json($last);
    }

    public function datanumeros(){
        $data = NumerosAreas::where('id_area', 'like', '%' . auth()->user()->area . '%')->get();
        return response()->json($data);

    }

    public function agregar(Request $request)
    {

        // Validacion de los datos
        $request->validate([
            'numeroId' => 'required|string|max:255',
        ]);

        $folconsec = '';
        $n = '';
        $area = auth()->user()->area;

        if($request->nfolios >1)
        {
            $folconsec = intval($request->numeroId) + intval($request->nfolios - 1);
            $n = $request->numeroId.'-'.$folconsec;

        }else{
            $n = $request->numeroId;
        }


        // Crear el Oficio
        NumerosAreas::create([
            'numeroId' => $n,
            'fecha' => Carbon::createFromFormat('Y-m-d', $request->fecha)->format('d/m/Y'),
            'area' => $request->area,
            'asunto' => $request->asunto,
            'solicita' => $request->solicita,
            'observaciones' => $request->observaciones,
            'id_area' => $area
        ]);

        // Redireccionar o devolver una respuesta adecuada
        return redirect()->back()->with('success', 'Registro creado correctamente.');
    }

    public function show($id)
    {

        $reg = NumerosAreas::where('numeroId','=',$id)->where('id_area', 'like', '%' . auth()->user()->area . '%')->first();
        return response()->json($reg);

    }

    function quitarAcentos($string) {
        $acentos = ['Á', 'É', 'Í', 'Ó', 'Ú'];
        $sinAcentos = ['A', 'E', 'I', 'O', 'U'];

        return str_replace($acentos, $sinAcentos, $string);
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
        $reg = NumerosAreas::where('numeroId','=',$id)->where('id_area','=', auth()->user()->area)->first();
        $reg->update($validatedData);

        $ruta = '/Acuses/'. $this->quitarAcentos(auth()->user()->area);

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
                $path = $ruta . '/' . $nombrearchivo;

                // Guardar el archivo en la carpeta especificada
                // Guardar el archivo en el FTP
                Storage::disk('ftp')->put($path, file_get_contents($archivoPDF));
            } else {
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

    public function listfiles($numeroId){
        $area = $this->quitarAcentos(auth()->user()->area);
        $rutaCarpeta = "Acuses/" . $area ."/";
            if (Storage::disk('ftp')->exists($rutaCarpeta)) {
                $data['area'] =  $area;
                $files = Storage::disk('ftp')->files($rutaCarpeta);

                $fileName = [];
                foreach($files as $file){

                    if(strpos(basename($file),$numeroId) !== false){
                         $fileName[] = basename($file);
                    }
                }

                $data['archivos'] =  $fileName;

                return response()->json($data);
            } else {
                return response()->json(["success"=>false]);
            }
    }

}


