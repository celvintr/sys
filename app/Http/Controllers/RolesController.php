<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{

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
        return view('roles.EditarRol', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        //
    }

    public function destroy(Role $role)
    {
        //
    }
}
