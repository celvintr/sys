<?php

namespace Database\Seeders;

use App\Models\PartidosPoliticos;
use Illuminate\Database\Seeder;

class PartidosPoliticosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PartidosPoliticos::insert([
            ['cod_partido' => 0, 'nombre_partido' => 'Partido Libertad y Refundación'],
            ['cod_partido' => 1, 'nombre_partido' => 'Partido Liberal'],
            ['cod_partido' => 3, 'nombre_partido' => 'Partido Nacional'],
        ]);
    }
}
