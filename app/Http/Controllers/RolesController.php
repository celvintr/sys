<?php

namespace App\Http\Controllers;

//use App\Models\Roles;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{

    public function index()
    {
        $roles = Role ::all();
        return view('roles.index',compact('roles'));
    }



    public function data(Request $request)
    {
        $Roles = Role::all();
        return response()->json($Roles);
    }


    public function create()
    {
        $permissions = Permission::all();
         return view('roles.AgregarRol',compact('permissions'));
    }


    public function store(Request $request)
    {

        $val = Validator::make($request->all(), [
            'name' => 'required',

        ]);

        if ($val->fails()) {
            return response()->json(['errors' => $val->errors()->all()]);
        }

        $role = Role::create($request->all());
        $role->permissions()->sync($request->permissions);

        //return redirect()->route('admin.roles.index')->with('info','El rol se creo!!');
        //return response()->json(['exito' => 'Nuevo rol agregado correctamente.']);
    }


    public function show(Role $role)
    {
        return view('roles.Show',compact('role'));
    }


    public function edit(Role $role)
    {
        return view('roles.EditarRol',compact('role'));
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
