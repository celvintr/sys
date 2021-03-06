<?php

namespace App\Http\Controllers;

use App\Exports\UsuariosExport;
use App\Models\CNE;
use App\Models\Departamentos;
use App\Models\Municipios;
use App\Models\PartidosPoliticos;
use App\Models\User;
use App\Models\Custodios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Spatie\Permission\Models\Role;
USE DB;

class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.usuarios.index')->only('index');
        $this->middleware('can:admin.usuarios.index')->only('data');
        $this->middleware('can:admin.usuarios.create')->only('create');
        $this->middleware('can:admin.usuarios.edit')->only('editar');
        $this->middleware('can:admin.usuarios.ficha')->only('ficha');

    }
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
            $query->where(function ($q) use ($buscar) {
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
        if ($estado_usuario) {
            $query->where('estado_usuario', $estado_usuario);
        }
        if ($cod_rol) {
            $query->whereHas('rol', function ($q) use ($cod_rol) {
                $q->where('role_id', $cod_rol);
            });
        }

        #valido rol
        if (!empty(Auth::user()->rol[0]->id)) {
            if (Auth::user()->rol[0]->id != 1) {
                $query->whereHas('rol', function ($q) use ($cod_rol) {
                    $q->where('role_id', '<>', 1);
                });
            }
        }

        #usuarios por roll y partido
        if (Auth::user()->rol[0]->id == 2 ) {
            $query->whereHas('partido', function($q) {
                $q->where('cod_partido', Auth::user()->cod_partido);
            });
        }

        #usuarios
        $usuarios = $query->with(['rol', 'partido'])->get();

        return response()->json($usuarios);
    }

    public function dataPartidos(Request $request)
    {
        #obtener el filtro del datatable
        $buscar = (!empty($request->all()['query']['buscar']) ? $request->all()['query']['buscar'] : null);
        $estado_usuario = (!empty($request->all()['query']['estado_usuario']) ? $request->all()['query']['estado_usuario'] : null);
        $cod_rol = (!empty($request->all()['query']['cod_rol']) ? $request->all()['query']['cod_rol'] : null);

        #usuarios
        $query = User::query();

        #filtro lista
        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
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
        if ($estado_usuario) {
            $query->where('estado_usuario', $estado_usuario);
        }
        if ($cod_rol) {
            $query->whereHas('rol', function ($q) use ($cod_rol) {
                $q->where('role_id', $cod_rol);
            });
        }

        #valido rol
        if (!empty(Auth::user()->rol[0]->id)) {
            if (Auth::user()->rol[0]->id != 1) {
                $query->whereHas('rol', function ($q) use ($cod_rol) {
                    $q->where('role_id', '<>', 1);
                });
            }
        }

        #usuarios por roll y partido
        if (Auth::user()->rol[0]->id == 2 ) {
            $query->whereHas('partido', function($q) {
                $q->where('cod_partido', Auth::user()->cod_partido);
            });
        }
        #usuarios
        $usuarios = $query->with(['rol', 'partido'])->get();

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

        #Partidos
        $partidos = PartidosPoliticos::all();

        $form = (object) [
            'dni_usuario' => '',
            'nombre_usuario' => '',
            'pass_usuario' => '',
            'cargo_usuario' => '',
            'tel_usuario' => '',
            'correo_usuario' => '',
            'cod_departamento' => '',
            'cod_municipio' => '',
            'dir_usuario' => '',
            'cod_rol' => '',
            'cod_partido' => '',
        ];

        return view('usuarios.create', [
            'departamentos' => $departamentos,
            'municipios' => $municipios,
            'roles' => $roles,
            'partidos' => $partidos,
            'form' => $form,
            'title' => 'Agregar Usuario',
            'btn' => 'Guardar',
            'method' => 'POST',
            'action' => route('admin.usuarios.store'),
        ]);
    }

    /**
     * Guardar nuevo registro
     */
    public function store(Request $request)
    {
        #Validar campos
        $validator = Validator::make($request->all(), [
            'dni_usuario' => 'required|unique:tbl_usuarios',
            'nombre_usuario' => 'required',
            // 'pass_usuario'              => 'required|confirmed',
            // 'pass_usuario_confirmation' => 'required',
            
            'tel_usuario' => 'required|regex:/^[0-9]+$/|max:8',
            'correo_usuario' => 'required',
            'cod_departamento' => 'required',
            'cod_municipio' => 'required',
            'dir_usuario' => 'required',
            'cod_rol' => 'required',
            
        ], [], [
            'dni_usuario' => 'DNI',
            'nombre_usuario' => 'Nombre',
            'pass_usuario' => 'Contrase??a',
            'pass_usuario_confirmation' => 'Confirmaci??n',
            
            'tel_usuario' => 'Telefono',
            'correo_usuario' => 'Correo',
            'cod_rol' => 'Rol',
            'cod_departamento' => 'Departamento',
            'cod_municipio' => 'Municipio',
            'dir_usuario' => 'Direccion',
            
        ]);

        //$existe = Custodios::where('dni_custodio', $request->dni_usuario)->first();
        //if (!is_null($existe)){
          //  return response()->json(['success' => 'USUARIO YA ES CUSTODIO']);
        //}

        #Si la validacion falla
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        #Encriptar password
        $pass_usuario = Hash::make($request->dni_usuario);

        if (Auth::user()->rol[0]->id==1){
            $v3=$request->cod_partido;
        }else{
            $v3=Auth::user()->cod_partido;
        }

        #Crear registro
        $usuario = User::create([
            'dni_usuario' => $request->dni_usuario,
            'nombre_usuario' => $request->nombre_usuario,
            'pass_usuario' => $pass_usuario,
            'cargo_usuario' => '',
            'tel_usuario' => $request->tel_usuario,
            'correo_usuario' => $request->correo_usuario,
            'cod_departamento' => $request->cod_departamento,
            'cod_municipio' => $request->cod_municipio,
            'dir_usuario' => $request->dir_usuario,
            'cod_partido' => $v3,
            'estado_usuario' => 1,
            'fecha_registro' => now(),
            'dni_usuario_registro' => Auth::user()->dni_usuario,
            'estado_sesion' => 0,
        ]);

        // Adding permissions via a role
        $usuario->assignRole($request->cod_rol);

        #Respuesta
        return response()->json(['success' => 'Usuario creado exitosamente']);
        
    }

    /**
     * Editar registro
     */
    public function editar($dni_usuario)
    {
        #Obtener usuario
        $form = User::with('rol')->findOrFail($dni_usuario);
        if (empty($form->rol[0]->id)) {
            $form->cod_rol = '';
        } else {
            $form->cod_rol = $form->rol[0]->id;
        }

        #valido rol
        if ($form->cod_rol == 1) {
            if (!empty(Auth::user()->rol[0]->id)) {
                if (Auth::user()->rol[0]->id != 1) {
                    abort(403, 'No tiene permisos.');
                }
            } else {
                abort(403, 'No tiene permisos.');
            }
        }

        #Obtengo todos los departamentos y municipios
        $departamentos = Departamentos::all();
        $municipios = Municipios::where('cod_departamento', $form->cod_departamento)->get();

        #Roles
        $roles = Role::all();

        #Partidos
        $partidos = PartidosPoliticos::all();

        return view('usuarios.create', [
            'departamentos' => $departamentos,
            'municipios' => $municipios,
            'roles' => $roles,
            'partidos' => $partidos,
            'form' => $form,
            'title' => 'Actualizar Usuario',
            'btn' => 'Actualizar',
            'method' => 'PUT',
            'action' => route('admin.usuarios.actualizar', $dni_usuario),
        ]);
    }

    /**
     * Guardar nuevo registro
     */
    public function actualizar(Request $request, $dni_usuario)
    {
        $user = User::with('rol')->findOrFail($dni_usuario);
        if (empty($user->rol[0]->id)) {
            $user->cod_rol = '';
        } else {
            $user->cod_rol = $user->rol[0]->id;
        }

        #Validar campos
        $validator = Validator::make($request->all(), [
            // 'nombre_usuario'            => 'required|regex:/^[A-Za-z ]+$/',
            'pass_usuario' => ($request->update_pass ? 'required|confirmed' : ''),
            'pass_usuario_confirmation' => ($request->update_pass ? 'required' : ''),
            'cargo_usuario' => 'required',
            'tel_usuario' => (($user->cod_rol == 3 || $user->cod_rol == 4) ? '' : 'required|regex:/^[0-9]+$/|max:8'),
            'correo_usuario' => (($user->cod_rol == 3 || $user->cod_rol == 4) ? '' : 'required'),
            'cod_departamento' => (($user->cod_rol == 3 || $user->cod_rol == 4) ? '' : 'required'),
            'cod_municipio' => (($user->cod_rol == 3 || $user->cod_rol == 4) ? '' : 'required'),
            'dir_usuario' => 'required',
            // 'cod_rol'                   => 'required',
            'cod_partido' => ($request->cod_rol == 2 ? 'required' : ''),
        ], [], [
            'dni_usuario' => 'DNI',
            'nombre_usuario' => 'Nombre',
            'pass_usuario' => 'Contrase??a',
            'pass_usuario_confirmation' => 'Confirmaci??n',
            'cargo_usuario' => 'Cargo',
            'tel_usuario' => 'Telefono',
            'correo_usuario' => 'Correo',
            'cod_rol' => 'Rol',
            'cod_departamento' => 'Departamento',
            'cod_municipio' => 'Municipio',
            'dir_usuario' => 'Direccion',
            'cod_partido' => 'Partido',
        ]);

        #Si la validacion falla
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        #Crear registro
        $usuario = User::find($dni_usuario);
        $usuario->update([
            // 'nombre_usuario'   => $request->nombre_usuario,
            'cargo_usuario' => $request->cargo_usuario,
            'tel_usuario' => $request->tel_usuario,
            'cod_departamento' => $request->cod_departamento,
            'cod_municipio' => $request->cod_municipio,
            'dir_usuario' => $request->dir_usuario,
            // 'cod_partido'      => ($request->cod_rol == 2 ? $request->cod_partido : null),
        ]);

        #Encriptar password
        if ($request->update_pass) {
            $pass_usuario = Hash::make($request->pass_usuario);
            $usuario->update([
                'pass_usuario' => $pass_usuario,
            ]);
        }

        // Adding permissions via a role
        $usuario->assignRole($request->cod_rol);

        #Respuesta
        return response()->json(['success' => 'Usuario actualizado exitosamente']);
    }

    public function eliminarusuario($dni_usuario)
    {
        User::find($dni_usuario)->delete();

        return response()->json([
            'type' => 'success',
            'message' => 'Usuario eliminado.',
        ]);
    }

    /**
     * Guardar nuevo registro
     */
    public function estatus(Request $request)
    {
        #Actualizar
        $usuario = User::find($request->dni_usuario);
        $usuario->update([
            'estado_usuario' => ($usuario->estado_usuario == 1 ? 2 : 1),
        ]);

        #Respuesta
        return response()->json(['success' => 'Usuario actualizado exitosamente']);
    }

    /**
     * Perfil de usuario.
     */
    public function perfil()
    {
        return view('usuarios.perfil');
    }

    /**
     * Guardar nuevo registro
     */
    public function perfilUpdate(Request $request)
    {
        #Validar campos
        $validator = Validator::make($request->all(), [
            'pass_usuario' => ($request->update_pass ? 'required|confirmed' : ''),
            'pass_usuario_confirmation' => ($request->update_pass ? 'required' : ''),
        ], [], [
            'pass_usuario' => 'Contrase??a',
            'pass_usuario_confirmation' => 'Confirmaci??n',
        ]);

        #Si la validacion falla
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        #Crear registro
        $usuario = User::find(Auth::user()->dni_usuario);

        #Encriptar password
        if ($request->update_pass) {
            $pass_usuario = Hash::make($request->pass_usuario);
            $usuario->update([
                'pass_usuario' => $pass_usuario,
            ]);
        }

        #Respuesta
        return response()->json(['success' => 'Perfil actualizado exitosamente']);
    }

    /**
     * Mostrar ficha
     */
    public function ficha($dni_usuario)
    {
        #Obtener usuario
        $form = User::with('rol')->findOrFail($dni_usuario);
        if (empty($form->rol[0]->id)) {
            $form->cod_rol = '';
        } else {
            $form->cod_rol = $form->rol[0]->id;
        }

        return view('usuarios.ficha', [
            'form' => $form,
            'title' => 'Ficha del Usuario',
        ]);
    }

    /**
     * Mostrar ficha
     */
   /* public function fichaImprimir($dni_usuario)
    {
        #Obtener usuario
        $form = User::with('rol')->findOrFail($dni_usuario);
        if (empty($form->rol[0]->id)) {
            $form->cod_rol = '';
        } else {
            $form->cod_rol = $form->rol[0]->id;
        }

        $pdf = PDF::loadView('usuarios.ficha_pdf', [
            'data' => $form,
        ]);
        return $pdf->download('ficha_' . $dni_usuario . '.pdf');
    }*/

    public function exportExcel(Request $request)
    {
        return Excel::download(new UsuariosExport($request->all()), 'usuarios.xlsx');
    }

    /**
     * Consutar DNI usuario
     */
    public function dni(Request $request)
    {
        $usuario = User::where('dni_usuario', $request->dni_usuario)->first();

        if (empty($usuario->dni_usuario)) {
            $data = CNE::where('numero_identidad', $request->dni_usuario)->first();

            if (empty($data->numero_identidad)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No se encontr?? este DNI en el censo nacional.',
                ]);
            } else {
                if ($data->codigo_habil_inhabil == 'H01') {
                    return response()->json([
                        'status' => 'OK',
                        'data' => $data,
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Este DNI se encuentra inhabilitado en el censo nacional.',
                    ]);
                }
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'DNI ya registrado en el sistema.',
            ]);
        }
    }

    /**
     * Actualizar password
     */
    public function password()
    {
        return view('usuarios.password');
    }

    /**
     * Guardar nuevo registro
     */
    public function passwordUpdate(Request $request)
    {
        #Validar campos
        $validator = Validator::make($request->all(), [
            'pass_usuario' => 'required|confirmed',
            'pass_usuario_confirmation' => 'required',
        ], [], [
            'pass_usuario' => 'Contrase??a',
            'pass_usuario_confirmation' => 'Confirmaci??n',
        ]);

        #Si la validacion falla
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $pass_usuario = Hash::make($request->pass_usuario);
        User::find(Auth::user()->dni_usuario)->update([
            'pass_usuario' => $pass_usuario,
            'estado_sesion' => 1,
        ]);

        #Respuesta
        return response()->json(['success' => 'Contrase??a actualizada exitosamente']);
    }
}
