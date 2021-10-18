<?php

namespace Database\Seeders;

use App\Models\Departamentos;
use Illuminate\Database\Seeder;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamentos::insert([
            ['cod_departamento' => '01', 'nombre_departamento' => 'Atlantida'],
            ['cod_departamento' => '02', 'nombre_departamento' => 'Colon'],
            ['cod_departamento' => '03', 'nombre_departamento' => 'Comayagua'],
            ['cod_departamento' => '04', 'nombre_departamento' => 'Copan'],
            ['cod_departamento' => '05', 'nombre_departamento' => 'Cortes'],
            ['cod_departamento' => '06', 'nombre_departamento' => 'Choluteca'],
            ['cod_departamento' => '07', 'nombre_departamento' => 'El Paraiso'],
            ['cod_departamento' => '08', 'nombre_departamento' => 'Francisco Morazan'],
            ['cod_departamento' => '09', 'nombre_departamento' => 'Gracias a Dios'],
            ['cod_departamento' => '10', 'nombre_departamento' => 'Intibuca'],
            ['cod_departamento' => '11', 'nombre_departamento' => 'Islas de La Bahia'],
            ['cod_departamento' => '12', 'nombre_departamento' => 'La Paz'],
            ['cod_departamento' => '13', 'nombre_departamento' => 'Lempira'],
            ['cod_departamento' => '14', 'nombre_departamento' => 'Ocotepeque'],
            ['cod_departamento' => '15', 'nombre_departamento' => 'Olancho'],
            ['cod_departamento' => '16', 'nombre_departamento' => 'Santa Barbara'],
            ['cod_departamento' => '17', 'nombre_departamento' => 'Valle'],
            ['cod_departamento' => '18', 'nombre_departamento' => 'Yoro'],
        ]);
    }
}
