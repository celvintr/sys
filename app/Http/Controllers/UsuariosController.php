<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Departamentos;
use App\Models\Municipios;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
{
    /**
     * Mostrar listado.
     */
    public function index()
    {
        $roles = Role::all();
        return view('usuarios.index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Obtener la data de la lista.
     */
    public function data(Request $request)
    {
        #obtener el filtro del datatable
        $buscar = (!empty($request->all()['query']['buscar']) ? $request->all()['query']['buscar'] : null);
        $estado_usuario = (!empty($request->all()['query']['estado_usuario']) ? $request->all()['query']['estado_usuario'] : null);
        $cod_rol = (!empty($request->all()['query']['cod_rol']) ? $request->all()['query']['cod_rol'] : null);

        #usuarios
        $query = User::query();

        #filtro lista
        if ($buscar) {
            $query->where(function($q) use ($buscar) {
                $q->where('nombre_usuario', 'LIKE', '%' . $buscar . '%');
                $q->orWhere('dni_usuario', 'LIKE', '%' . $buscar . '%');
                $q->orWhere('cargo_usuario', 'LIKE', '%' . $buscar . '%');
                $q->orWhere('correo_usuario', 'LIKE', '%' . $buscar . '%');
                $q->orWhere('tel_usuario', 'LIKE', '%' . $buscar . '%');
            });
        }
        if ($estado_usuario) {
            $query->where('estado_usuario', $estado_usuario);
        }
        if ($cod_rol) {
            $query->where('cod_rol', $cod_rol);
        }

        #usuarios
        $usuarios = $query->with('rol')->get();

        return response()->json($usuarios);
    }

    /**
     * Mostrar formulario de crear
     */
    public function create()
    {
        #Obtengo todos los departamentos y municipios
        $departamentos = Departamentos::all();
        $municipios = [];

        #Roles
        $roles = Role::all();

        $form = (object) [
            'dni_usuario'          => '',
            'nombre_usuario'       => '',
            'pass_usuario'         => '',
            'cargo_usuario'        => '',
            'tel_usuario'          => '',
            'correo_usuario'       => '',
            'cod_departamento'     => '',
            'cod_municipio'        => '',
            'dir_usuario'          => '',
            'cod_rol'          => '',
            'estado_usuario'       => 1,
        ];

        return view('usuarios.create', [
            'departamentos' => $departamentos,
            'municipios'    => $municipios,
            'roles'         => $roles,
            'form'          => $form,
            'title'         => 'Agregar Usuario',
            'btn'           => 'Guardar',
            'method'        => 'POST',
            'action'        => route('admin.usuarios.store'),
        ]);
    }

    /**
     * Guardar nuevo registro
     */
    public function store(Request $request)
    {
        #Validar campos
        $validator = Validator::make($request->all(), [
            'dni_usuario'               => 'required|unique:tbl_usuarios',
            'nombre_usuario'            => 'required',
            'pass_usuario'              => 'required|confirmed',
            'pass_usuario_confirmation' => 'required',
            'cargo_usuario'             => 'required',
            'tel_usuario'               => 'required',
            'correo_usuario'            => 'required',
            'cod_departamento'          => 'required',
            'cod_municipio'             => 'required',
            'dir_usuario'               => 'required',
        ], [], [
            'dni_usuario'               => 'DNI',
            'nombre_usuario'            => 'Nombre',
            'pass_usuario'              => 'Contraseña',
            'pass_usuario_confirmation' => 'Confirmación',
            'cargo_usuario'             => 'Cargo',
            'tel_usuario'               => 'Telefono',
            'correo_usuario'            => 'Correo',
            'cod_rol'                   => 'Rol',
            'cod_departamento'          => 'Departamento',
            'cod_municipio'             => 'Municipio',
            'dir_usuario'               => 'Direccion',
        ]);

        #Si la validacion falla
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        #Encriptar password
        $pass_usuario = Hash::make($request->pass_usuario);

        #Crear registro
        $usuario = User::create([
            'dni_usuario'          => $request->dni_usuario,
            'nombre_usuario'       => $request->nombre_usuario,
            'pass_usuario'         => $pass_usuario,
            'cargo_usuario'        => $request->cargo_usuario,
            'tel_usuario'          => $request->tel_usuario,
            'correo_usuario'       => $request->correo_usuario,
            'cod_rol'              => $request->cod_rol,
            'cod_departamento'     => $request->cod_departamento,
            'cod_municipio'        => $request->cod_municipio,
            'dir_usuario'          => $request->dir_usuario,
            'estado_usuario'       => ($request->estado_usuario ? 1 : 2),
            'fecha_registro'       => now(),
            'dni_usuario_registro' => Auth::user()->dni_usuario,
        ]);

        #Respuesta
        return response()->json(['success' => 'Usuario creado exitosamente']);
    }

    /**
     * Editar registro
     */
    public function editar($idc_usuario)
    {
        #Obtener usuario
        $form = User::findOrFail($idc_usuario);

        #Obtengo todos los departamentos y municipios
        $departamentos = Departamentos::all();
        $municipios = Municipios::where('cod_departamento', $form->cod_departamento)->get();

        #Roles
        $roles = Role::all();

        return view('usuarios.create', [
            'departamentos' => $departamentos,
            'municipios'    => $municipios,
            'roles'         => $roles,
            'form'          => $form,
            'title'         => 'Actualizar Usuario',
            'btn'           => 'Actualizar',
            'method'        => 'PUT',
            'action'        => route('admin.usuarios.actualizar', $idc_usuario),
        ]);
    }

    /**
     * Guardar nuevo registro
     */
    public function actualizar(Request $request, $idc_usuario)
    {
        #Validar campos
        $validator = Validator::make($request->all(), [
            'nombre_usuario'            => 'required|regex:/^[A-Za-z ]+$/',
            'pass_usuario'              => ($request->update_pass ? 'required|confirmed' : ''),
            'pass_usuario_confirmation' => ($request->update_pass ? 'required' : ''),
            'cargo_usuario'             => 'required',
            'tel_usuario'               => 'required|regex:/^[0-9]+$/|max:8',
            'cod_departamento'          => 'required',
            'cod_municipio'             => 'required',
            'dir_usuario'               => 'required',
        ], [], [
            'dni_usuario'               => 'DNI',
            'nombre_usuario'            => 'Nombre',
            'pass_usuario'              => 'Contraseña',
            'pass_usuario_confirmation' => 'Confirmación',
            'cargo_usuario'             => 'Cargo',
            'tel_usuario'               => 'Telefono',
            'correo_usuario'            => 'Correo',
            'cod_rol'                   => 'Rol',
            'cod_departamento'          => 'Departamento',
            'cod_municipio'             => 'Municipio',
            'dir_usuario'               => 'Direccion',
        ]);

        #Si la validacion falla
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        #Crear registro
        User::find($idc_usuario)->update([
            'nombre_usuario'   => $request->nombre_usuario,
            'cargo_usuario'    => $request->cargo_usuario,
            'cod_rol'          => $request->cod_rol,
            'tel_usuario'      => $request->tel_usuario,
            'cod_departamento' => $request->cod_departamento,
            'cod_municipio'    => $request->cod_municipio,
            'dir_usuario'      => $request->dir_usuario,
            'estado_usuario'   => ($request->estado_usuario ? 1 : 2),
        ]);

        #Encriptar password
        if ($request->update_pass) {
            $pass_usuario = Hash::make($request->pass_usuario);
            User::find($idc_usuario)->update([
                'pass_usuario' => $pass_usuario,
            ]);
        }

        #Respuesta
        return response()->json(['success' => 'Usuario actualizado exitosamente']);
    }

    public function eliminarusuario($idc_usuario)
    {
        User::find($idc_usuario)->delete();

        return response()->json([
            'type' => 'success',
            'message' => 'Usuario eliminado.',
        ]);
    }
}
