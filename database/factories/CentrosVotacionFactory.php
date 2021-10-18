<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class CentrosVotacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $municipio = DB::table('tbl_municipios')
            ->inRandomOrder()
            ->first();

        return [
            'cod_municipio' => $municipio->cod_municipio,
            'nombre_centro' => $this->faker->words,
        ];
    }
}
