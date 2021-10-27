<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role1=Role::create(['name'=>'Super Administrador']);
        $role2=Role::create(['name'=>'Operador de Sistema']);
        $role3=Role::create(['name'=>'Colaborador']);
        $role4=Role::create(['name'=>'Jefe de Área']);

        //Permisos generales (Menu)
        Permission::create(['name'=>'admin.bitacoras.index','description'=>'Bitacoras','type'=>'1'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.custodios.index','description'=>'Custodios','type'=>'1'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.custodios.create','description'=>'Custodios','type'=>'1'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.custodios.delete','description'=>'Custodios','type'=>'1'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.custodios.edit','description'=>'Custodios','type'=>'1'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.roles.index','description'=>'Roles','type'=>'1'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.roles.create','description'=>'Roles','type'=>'1'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.roles.edit','description'=>'Roles','type'=>'1'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.usuarios.index','description'=>'Usuarios','type'=>'1'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.usuarios.create','description'=>'Usuarios','type'=>'1'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.usuarios.editar','description'=>'Usuarios','type'=>'1'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.usuarios.destroy','description'=>'Usuarios','type'=>'1'])->syncRoles([$role1,$role2]);
    }
}
