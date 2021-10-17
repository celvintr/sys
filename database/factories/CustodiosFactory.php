<?php

namespace Database\Factories;

use App\Models\Custodios;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustodiosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Custodios::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $num = $this->faker->numberBetween();
        $dni = str_pad($num, 13, "0", STR_PAD_LEFT);

        return [
            'dni_custodio'     => $dni,
            'nombre_custodio'  => $this->faker->name,
            'tel_movil'        => $this->faker->phoneNumber,
            'tel_fijo'         => $this->faker->phoneNumber,
            'correo1_custodio' => $this->faker->email,
            'correo2_custodio' => $this->faker->freeEmail,
            'dir_custodio'     => $this->faker->address,
        ];
    }
}
