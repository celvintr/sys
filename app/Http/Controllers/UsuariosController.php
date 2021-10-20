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
            'dni_usuario'       => 'required',
            'nombre_usuario'    => 'required',
            'tel_movil'          => 'required',
            'pass_usuario'   => 'required',
            'cargo_usuario'      => 'required',
            'cod_rol'  => 'required',
            'tel_usuario' => 'required',
            'correo_usuario'      => 'required',
            'cod_departamento'        => 'required',
            'cod_municipio'         => 'required',
            'dir_usuario'         => 'required',
            'estado_usuario'         => 'required',
            'fecha_registro'         => 'required',
            'dni_usuario_registro'         => 'required',
        ], [], [
            'dni_usuario'       => 'DNI',
            'nombre_usuario'    => 'Nombre',
            'tel_movil'          => 'Telefono',
            'pass_usuario'   => 'Contraseña',
            'cargo_usuario'      => 'Cargo',
            'cod_rol'  => 'required',
            'tel_usuario' => 'required',
            'correo_usuario'      => 'required',
            'cod_departamento'        => 'required',
            'cod_municipio'         => 'required',
            'dir_usuario'         => 'required',
            'estado_usuario'         => 'required',
            'fecha_registro'         => 'required',
            'dni_usuario_registro'         => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

     

        $usuarios = User::create([
            'dni_custodio'         => $request->dni_custodio,
            'nombre_custodio'      => $request->nombre_custodio,
            'tel_movil'            => $request->tel_movil,
            'tel_fijo'             => $request->tel_fijo,
            'correo1_custodio'     => $request->correo1_custodio,
            'correo2_custodio'     => $request->correo2_custodio,
            'foto_custodio'        => $foto_custodio,
            'foto_dni_custodio'    => $foto_dni_custodio,
            'foto_comp_custodio'   => $foto_comp_custodio,
            'cod_municipio'        => $request->cod_municipio,
            'dir_custodio'         => $request->dir_custodio,
            'cod_partido'          => $request->cod_partido,
            'cod_centro'           => $request->cod_centro,
            'fecha_registro'       => now(),
            'dni_usuario_registro' => Auth::user()->dni_usuario,
        ]);

        return response()->json(['success' => 'Custodio creado exitosamente']);
    }



    public function data(Request $request)
    {
        $usuarios = User::all();

        return response()->json($usuarios);
    }

 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function eliminarusuario($idc_usuario)
    { 
        User::where('idc_usuario',$idc_usuario)->delete();
        return response()->json([
            'type' => 'success',
            'message' => 'Usuario eliminado.',
        ]);
    }


   
}
