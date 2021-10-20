<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Custodios;
use App\Models\Departamentos;
use App\Models\DNI;
use App\Models\PartidosPoliticos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


 
class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('usuarios.index');
    }

    public function create()
    {

     //   $form = null;
        $departamentos = Departamentos::all();
       // $partidos = PartidosPoliticos::all();

      //  if (session()->has('dni')) {
        //    $form = (object) [
         //       'dni_custodio'    => session('dni')['dni_custodio'],
          //      'nombre_custodio' => session('dni')['nombre_custodio'],
         //   ];
       // }

        return view('usuarios.create', [
         //   'form'          => $form,
            'departamentos' => $departamentos,
         //   'partidos'      => $partidos,
        ]);


        
      //  return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dni_usuario'        => 'required',
            'nombre_usuario'     => 'required',
            'pass_usuario'       => 'required',
            'cargo_usuario'      => 'required',
            'cod_rol'            => 'required',
            'tel_usuario'        => 'required',
            'correo_usuario'     => 'required',
            'cod_departamento'   => 'required',
            'cod_municipio'      => 'required',
            'dir_usuario'        => 'required',
            'estado_usuario'     => 'required',
            'fecha_registro'     => 'required',
         ], [], [
            'dni_usuario'        => 'DNI',
            'nombre_usuario'     => 'Nombre',
            'pass_usuario'       => 'Contraseña',
            'cargo_usuario'      => 'Cargo',
            'cod_rol'            => 'required',
            'tel_usuario'        => 'Telefono',
            'correo_usuario'     => 'Correo',
            'cod_departamento'   => 'Departamento',
            'cod_municipio'      => 'Municipio',
            'dir_usuario'        => 'Direccion',
            'estado_usuario'     => 'Estado',
            'fecha_registro'     => 'Fecha',
         ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

     

        $usuarios = User::create([
            'dni_usuario'          => $request->dni_usuario,
            'nombre_usuario'       => $request->nombre_usuario,
            'pass_usuario'         => $request->pass_usuario,
            'cargo_usuario'        => $request->cargo_usuario,
            'cod_rol'              => $cod_rol,
            'tel_usuario'          => $tel_usuario,
            'correo_usuario'       => $request->correo_usuario,
            'cod_departamento'     => $request->cod_departamento,
            'cod_municipio'        => $request->cod_municipio,
            'estado_usuario'       => $request->estado_usuario,
            'dir_usuario'          => $request->dir_usuario,           
            'fecha_registro'       => now(),
            'dni_usuario_registro' => Auth::user()->dni_usuario,
        ]);

        return response()->json(['success' => 'Usuario creado exitosamente']);
    }



    public function data(Request $request)
    {
        $usuarios = User::all();

        return response()->json($usuarios);
    }

  
    public function eliminarusuario($idc_usuario)
    { 
        User::where('idc_usuario',$idc_usuario)->delete();
        return response()->json([
            'type' => 'success',
            'message' => 'Usuario eliminado.',
        ]);
    }


   
}
