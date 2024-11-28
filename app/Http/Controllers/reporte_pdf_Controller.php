<?php

namespace App\Http\Controllers;

use App\Models\ModelCorrepondencia;

use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Carbon\Carbon;
use DateTime;
use Dompdf\Adapter\PDFLib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PDF; // Importa la clase PDF
use PhpParser\Node\Stmt\TryCatch;

class reporte_pdf_Controller extends Controller
{

    //
    public function generarPdf(Request $request)
    {
        $request->validate([
            'fecha_ini' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        ini_set('memory_limit', '5G');
        ini_set('max_execution_time', '300');
        // $fecha_ini = $request->fecha_ini;
        // $fecha_fin = $request->fecha_fin;
        // //dd(fecha_ini);

        // $fecha_ini_obj = new DateTime($fecha_ini);
        // $fecha_fin_obj = new DateTime($fecha_fin);

        // Convertir las fechas de entrada al formato 'd/m/Y' para que coincidan con el formato de la base de datos
        $fecha_inicial = Carbon::createFromFormat('Y-m-d', $request->fecha_ini)->format('d/m/Y');
        $fecha_final = Carbon::createFromFormat('Y-m-d', $request->fecha_fin)->format('d/m/Y');
        $area = auth()->user()->area; // Area del usuario autenticado.
        // Realizar la consulta con str_to_date para comparar las fechas correctamente
        try{
            if($area == 'COORDINACIÓN'){
                $datos = ModelCorrepondencia::whereRaw(
                    'interno = ? and area = ? and str_to_date(fecha_oficio, "%d/%m/%Y") BETWEEN str_to_date(?, "%d/%m/%Y") AND str_to_date(?, "%d/%m/%Y") order by fecha_oficio',
                    ['0', $area,$fecha_inicial, $fecha_final]
                )->get();
            }else {
                $datos = ModelCorrepondencia::whereRaw(
                    'interno = ? and area = ? and str_to_date(fecha_oficio, "%d/%m/%Y") BETWEEN str_to_date(?, "%d/%m/%Y") AND str_to_date(?, "%d/%m/%Y") order by fecha_oficio',
                    ['1', $area,$fecha_inicial, $fecha_final]
                )->get();
            }

        }catch (\Exception $e) {
            Log::error('Error al obtener personal: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }



        // Cargar la vista y pasarle los datos
        $pdf = FacadePdf::loadView('pdf.pdfreporte', compact('datos','fecha_inicial','fecha_final'));
        $pdf->setPaper('A4', 'landscape');  // Para orientación horizontal
        // Devolver el PDF como respuesta
        return $pdf->download('Reporte de oficios recibidos.pdf');


    }



}
