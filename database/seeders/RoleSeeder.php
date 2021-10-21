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
        $role1=Role::create(['name'=>'Administrador del sistema']);
        $role2=Role::create(['name'=>'Operador de sistema']);

        //Permisos generales (Menu)
        Permission::create(['name'=>'admin.parametros-generales.index','description'=>'Acceder a parámetros generales','type'=>'1'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.medios-de-prueba.index','description'=>'Acceder a los medios de prueba','type'=>'1'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.usuarios.index','description'=>'Ver lista de usuarios','type'=>'2'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.index','description'=>'Ver lista de roles','type'=>'2'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.bitacora-estados.index','description'=>'Ver bitácora de estados de custodios','type'=>'3'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.custodios.create','description'=>'Ingresar nuevo custodio','type'=>'3'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.custodios.consultar','description'=>'Consultar lista de custodios','type'=>'3'])->syncRoles([$role1]);
    }
}
