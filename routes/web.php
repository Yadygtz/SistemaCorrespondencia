<?php

use App\Http\Controllers\CorrespondenciaController;
use App\Http\Controllers\NumerosAreasAntController;
use App\Http\Controllers\NumerosAreasController;
use App\Http\Controllers\RegistroNumerosController;
use App\Http\Controllers\RegistroNumerosControllerAnt;
use App\Http\Controllers\reporte_pdf_Controller;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });

//  Auth::routes();



Route::middleware('auth')->group(function () {
    Route::resource('usuarios', UsuariosController::class);
    Route::get('/', function () {
        return redirect('/correspondencia');
    });

    Route::get('/correspondencia', [CorrespondenciaController::class, 'index'])->name('correspondencia');
    // Route::resource('correspondencia', CorrespondenciaController::class);
    Route::get('/correspondencia/{id}', [CorrespondenciaController::class, 'show'])->name('correspondencia.show');
    Route::put('/correspondencia/upd/{id}', [CorrespondenciaController::class, 'editar'])->name('correspondencia.editar');
    Route::put('/correspondencia/add', [CorrespondenciaController::class, 'agregar'])->name('correspondencia.agregar');
    Route::get('/dsdataoficios', [CorrespondenciaController::class, 'dataoficios'])->name('dsdataoficios');


    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/RegistroNumeros', [RegistroNumerosController::class, 'index'])->name('RegistroNumeros');
    Route::get('/RegistroNumeros/{id}', [RegistroNumerosController::class, 'show'])->name('RegistroNumeros.show');
    Route::put('/RegistroNumeros/upd/{id}', [RegistroNumerosController::class, 'editar'])->name('RegistroNumeros.actualizar');
    Route::put('/RegistroNumeros/add', [RegistroNumerosController::class, 'agregar'])->name('RegistroNumeros.agregar');
    Route::get('/GetId', [RegistroNumerosController::class, 'ultimoId'])->name('RegistroNumeros.GetId');
    Route::get('/dsdatanumeros', [RegistroNumerosController::class, 'datanumeros'])->name('dsdatanumeros');
    Route::get('/RegistroNumeros/lista/{numeroId}', [RegistroNumerosController::class, 'listfiles'])->name('RegistroNumeros.listfiles');

    Route::get('/RegistroNumerosAnt', [RegistroNumerosControllerAnt::class, 'index'])->name('RegistroNumerosAnt');
    Route::get('/dsdatanumerosAnt', [RegistroNumerosControllerAnt::class, 'datanumerosAnt'])->name('dsdatanumerosAnt');


    Route::get('/NumerosAreas', [NumerosAreasController::class, 'index'])->name('NumerosAreas');
    Route::get('/dsdatanumeros2', [NumerosAreasController::class, 'datanumeros'])->name('dsdatanumeros2');
    Route::put('/NumerosAreas/add', [NumerosAreasController::class, 'agregar']);
    Route::get('/GetId2', [RegistroNumerosController::class, 'ultimoId'])->name('RegistroNumeros.GetId2');
    Route::put('/NumerosAreas/upd2/{id}', [NumerosAreasController::class, 'editar'])->name('NumerosAreas.editar');
    Route::get('/NumerosAreas2/{id}', [NumerosAreasController::class, 'show'])->name('NumerosAreas.show');
    Route::get('/NumerosAreas/lista2/{numeroId}', [NumerosAreasController::class, 'listfiles'])->name('NumerosAreas.list2');

    Route::get('/NumerosAreasAnt', [NumerosAreasAntController::class, 'index'])->name('NumerosAreasAnt');
    Route::get('/dsdatanumeros2Ant', [NumerosAreasAntController::class, 'datanumerosAnt'])->name('dsdatanumeros2Ant');

    /* OBTENER EL ARCHIVO DEL SERVER FTP*/
    // Expediente digital
    Route::get('veroficio/{oficio}', function ($oficio) {
        // Verificar en cuál de los dos servidores se encuentra el fichero
        $rutaCompletaFTP = "Oficios/" . $oficio . ".pdf";
        if (Storage::disk('ftp')->exists($rutaCompletaFTP)) {
            if (ob_get_level()) ob_end_clean();
            $file = Storage::disk('ftp')->get($rutaCompletaFTP);

            $response = Response::make($file, 200);
            $response->header('Content-Type', 'application/pdf');

            return $response;
        } else {
            return "Archivo no encontrado";
        }

        return $oficio;
    })->name('veroficio');

    //oficios Numeros
    Route::get('verPDF/{carpeta}/{archivo}', function ($carpeta,$archivo) {
        // Verificar en cuál de los dos servidores se encuentra el fichero
        $rutaCompletaFTP = "Acuses/" . $carpeta . "/" . $archivo;
        if (Storage::disk('ftp')->exists($rutaCompletaFTP)) {
            if (ob_get_level()) ob_end_clean();
            $file = Storage::disk('ftp')->get($rutaCompletaFTP);

            $response = Response::make($file, 200);
            $response->header('Content-Type', 'application/pdf');

            return $response;
        } else {
            return "Archivo no encontrado";
        }

        return $oficio;
    })->name('verPDF');

    //oficios Numeros todas las areas
    Route::get('verPDF2/{carpeta}/{archivo}', function ($carpeta,$archivo) {
        // Verificar en cuál de los dos servidores se encuentra el fichero
        $rutaCompletaFTP = "Acuses/" . $carpeta . "/" . $archivo;
        if (Storage::disk('ftp')->exists($rutaCompletaFTP)) {
            if (ob_get_level()) ob_end_clean();
            $file = Storage::disk('ftp')->get($rutaCompletaFTP);

            $response = Response::make($file, 200);
            $response->header('Content-Type', 'application/pdf');

            return $response;
        } else {
            return "Archivo no encontrado";
        }

        return $oficio;
    })->name('verPDF2');

    Route::post('/reporte', [reporte_pdf_Controller::class, 'generarPdf'])->name('reporte');

});


