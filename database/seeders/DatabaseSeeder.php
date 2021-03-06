<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DepartamentosSeeder::class,
            MunicipiosSeeder::class,
            PartidosPoliticosSeeder::class,
            RoleSeeder::class,
        ]);

        \App\Models\User::factory(1)->su()->create();   //  aqui creo el admin fijo
        \App\Models\User::factory(50)->create();        //  aqui creo 50 usuarios aleatorios
        \App\Models\Custodios::factory(50)->create();
        \App\Models\CentrosVotacion::factory(50)->create();

        User::find('0000123456789')->assignRole(1);

        // \App\Models\User::factory(10)->create();
    }
}
