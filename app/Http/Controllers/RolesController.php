<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function __construct()
    {
        //$this->middleware('can:admin.roles.index');
        //$this->middleware('can:admin.usuarios.edit')->only('edit', 'update');
    }
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function data(Request $request)
    {
        $Roles = Role::all();
        return response()->json($Roles);
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.AgregarRol', compact('permissions'));
    }

    public function store(Request $request)
    {

        $val = Validator::make($request->all(), [
            'name' => 'required',

        ], [], [
            'name' => 'Nombre de rol',

        ]);
        if ($val->fails()) {
            return response()->json(['errors' => $val->errors()->all()]);
        }

        $Roles = Role::all();
        $exist = false;
        foreach ($Roles as $rol) {
            if ($rol['name'] == $request->name) {
                $exist = true;
            }
        }

        if (empty($request->permissions)) {
            return response()->json(['exist_rol' => 'Agregue almenos un permiso al rol']);
        }

        if ($exist) {
            return response()->json(['exist_rol' => 'El nombre del rol ya existe']);
        } else {
            $role = Role::create($request->all());
            $role->permissions()->sync($request->permissions);
            return response()->json(['success' => 'Rol agregado exitosamente']);
            return redirect()->route('admin.roles.index');
        }

    }

    public function show(Role $role)
    {

    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.EditarRol', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {

        $val = Validator::make($request->all(), [
            'name' => 'required',

        ], [], [
            'name' => 'Nombre de rol',

        ]);
        if ($val->fails()) {
            return response()->json(['errors' => $val->errors()->all()]);
        }

        if (empty($request->permissions)) {
            return response()->json(['norol' => 'Agregue almenos un permiso al rol']);
        }

        $Roles = Role::all();
        $exist = false;
        foreach ($Roles as $rol) {
            if ($rol['id'] != $request->id) {
                if ($rol['name'] == $request->name) {
                    $exist = true;
                }
            }

        }

        if ($exist) {
            //"]);
            //$request->session()->flash('existe', "No se encontró este DNI en el censo nacional.");
            return response()->json(['existe' => 'El nombre del rol ya existe']);
        } else {
            $role = Role::find($request->id);
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($request->permissions);
            return response()->json(['success' => 'El rol fue actualizado exitosamente']);
            return redirect()->route('roles.index');
        }

    }

    public function destroy($role)
    {

        $role = Role::find($role);
        $role->delete();

        return response()->json([
            'type' => 'success',
            'message' => $role,
        ]);
        return redirect()->route('roles.index');
    }
}
