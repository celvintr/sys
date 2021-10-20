<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

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
            
            'dni_usuario'    => $dni,
            'nombre_usuario' => $this->faker->name,
            'pass_usuario'   => Hash::make('password'),
            'cargo_usuario'  => $this->faker->word,
            'tel_usuario'    => $this->faker->phoneNumber,
            'dir_usuario'    => $this->faker->address,
        ];
    }

    /**
     * User admin.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function su()
    {
        return $this->state(function (array $attributes) {
            return [
                'dni_usuario'    => "0000123456789",
                'nombre_usuario' => 'Administrador',
                'pass_usuario'   => Hash::make('password'),
                'cargo_usuario'  => 'Superusuario',
            ];
        });
    }
}
