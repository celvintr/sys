<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->su()->create();   //  aqui creo el admin fijo
        // \App\Models\User::factory(50)->create();        //  aqui creo 50 usuarios aleatorios
        \App\Models\Custodios::factory(500)->create();

        // \App\Models\User::factory(10)->create();
    }
}
