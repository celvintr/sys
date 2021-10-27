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
            ['nombre_partido' => 'Partido Libertad'],
            ['nombre_partido' => 'Partido Nacional'],
            ['nombre_partido' => 'PINU'],
            ['nombre_partido' => 'DC'],
            ['nombre_partido' => 'UD'],
            ['nombre_partido' => 'PAC'],
            ['nombre_partido' => 'Partido Libertad y Refundación'],
            ['nombre_partido' => 'AP'],
            ['nombre_partido' => 'FRENTE'],
            ['nombre_partido' => 'VAMOS'],
            ['nombre_partido' => 'NUEVA RUTA'],
            ['nombre_partido' => 'PSH'],
            ['nombre_partido' => 'LIDER'],
            ['nombre_partido' => 'TSH'],
        ]);
    }
}
