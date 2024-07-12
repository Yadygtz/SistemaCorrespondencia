<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    //
    public function index()
    {

        $RegUsuarios = User::get();


        return view('usuarios', compact('RegUsuarios'));
    }

    public function create(Request $request){
        $usuario="usuario";
        return view("auth.registro",compact("usuario"));
    }

    public function store(Request $request){
        User::create([
            'name' => $request['name'],
            'paterno' => $request['paterno'],
            'materno' => $request['materno'],
            'tipo_usuario' => $request['tusuario'],
            'area' => $request['area'],
            'email' => $request['email'],
            'clave' => $request['clave'],
            'password' => Hash::make($request['password'])

        ]);
        // Redireccionar o devolver una respuesta adecuada
        return redirect()->route('usuarios.index');
    }

    public function edit(User $usuario){
        $id = $usuario->id;
        return view("auth.registro",compact('usuario','id'));
    }

    public function update(Request $request, $id)
    {
        //dd($id);
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'paterno' => 'string|max:255',
            'materno' =>  'string|max:255',
            'tusuario' => 'string|max:255',
            'area' => 'string|max:255',
            'clave' => 'string|max:255',
            'password' =>'max:255'

            // Añade las reglas de validación para el resto de los campos
            // 'oficioPDF' => 'file|mimes:pdf',
        ]);


        // Encontrar el registro por ID y actualizarlo
        $usuario = User::where('id','=',$id)->first();


        if($request->input('password'))
        {
            //dd($request->has('password'));
            try {
                $usuario->update(
                    [
                        'name'=>$request->name,
                        'paterno'=>$request->paterno,
                        'materno'=>$request->materno,
                        'tipo_usuario'=>$request->tusuario,
                        'area' => $request->area,
                        'email' => $request->email,
                        'clave' => $request->clave,
                        'password' => Hash::make($request->password),

                    ]
                );

            } catch (\Throwable $th) {
               dd($th);
            }


        }else {
            try {
                $usuario->update(
                    [
                        'name'=>$request->name,
                        'paterno'=>$request->paterno,
                        'materno'=>$request->materno,
                        'tipo_usuario'=>$request->tusuario,
                        'area' => $request->area,
                        'email' => $request->email,
                        'clave' => $request->clave,


                    ]
                );

            } catch (\Throwable $th) {
               dd($th);
            }

        }



        // Redireccionar o devolver una respuesta adecuada
        return redirect()->route('usuarios.index');

    }
}
