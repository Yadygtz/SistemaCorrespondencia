<?php

namespace App\Http\Controllers;

use App\Models\NumerosAreasAnt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NumerosAreasAntController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$RegNumeros = RegistroNumeros::take(30)->get();
        //$noficio =  DB::table('registro_numeros')->select('numeroId')->get();
        $areas = ['INTEGRACIÓN','ADMINISTRATIVO','COORDINACIÓN','JURÍDICO','PROGRAMACIÓN',
        'INFORMÁTICA','ANTECEDENTES','PLANEACIÓN E INNOVACIÓN','SOCIOECONÓMICO','PSICOLOGÍA','LIBRE','VALIDACIÓN','MEDICO','POLIGRAFÍA'];
        $areasCB = '';
        foreach ($areas as $area) {
            $areasCB .= "<option value='" . $area . "'>" . $area . "</option>";
        }

        return view('NumerosAreasAnt', compact('areasCB'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function datanumerosAnt(){
        $data = NumerosAreasAnt::where('id_area', 'like', '%' . auth()->user()->area . '%')->get();
        return response()->json($data);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $reg = NumerosAreasAnt::where('numeroId','=',$id)->where('id_area', 'like', '%' . auth()->user()->area . '%')->first();
        return response()->json($reg);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listfiles($numeroId){
        $area = $this->quitarAcentos(auth()->user()->area);
        $rutaCarpeta = "Acuses/" . $area ."/";
            if (Storage::disk('ftp')->exists($rutaCarpeta)) {
                $data['area'] =  $area;
                $files = Storage::disk('ftp')->files($rutaCarpeta);

                $fileName = [];
                foreach($files as $file){
                    if(strtolower(basename($file)) === strtolower($numeroId . '.pdf')){
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
