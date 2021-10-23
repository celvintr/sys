<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_USUARIOS', function (Blueprint $table) {
            $table->string('dni_usuario', 13);
            $table->text('nombre_usuario');
            $table->text('pass_usuario');
            $table->text('cargo_usuario')->nullable();
            $table->text('tel_usuario')->nullable();
            $table->string('correo_usuario', 50)->nullable();
            $table->string('cod_departamento', 2)->nullable();
            $table->string('cod_municipio', 4)->nullable();
            $table->text('dir_usuario')->nullable();
            $table->bigInteger('cod_partido')->nullable();
            $table->tinyInteger('estado_usuario')->default(1);
            $table->dateTime('fecha_registro')->nullable();
            $table->bigInteger('dni_usuario_registro')->nullable();
            $table->primary('dni_usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
