<?php

use App\Http\Controllers\CorrespondenciaController;
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

Auth::routes();


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('/correspondencia');
    });

    Route::get('/correspondencia', [CorrespondenciaController::class, 'index'])->name('correspondencia');
    // Route::resource('correspondencia', CorrespondenciaController::class);
    Route::get('/correspondencia/{id}', [CorrespondenciaController::class, 'show']);
    Route::put('/correspondencia/upd/{id}', [CorrespondenciaController::class, 'editar']);
    Route::put('/correspondencia/add', [CorrespondenciaController::class, 'agregar']);


    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

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
});
