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
        Schema::create('tbl_usuarios', function (Blueprint $table) {
            $table->string('dni_usuario', 13);
            $table->text('nombre_usuario');
            $table->text('pass_usuario');
            $table->text('cargo_usuario')->nullable();
            $table->bigInteger('cod_rol')->nullable();
            $table->text('tel_usuario')->nullable();
            $table->bigInteger('correo_usuario')->nullable();
            $table->bigInteger('cod_departamento')->nullable();
            $table->bigInteger('cod_municipio')->nullable();
            $table->text('dir_usuario')->nullable();
            $table->bigInteger('estado_usuario')->nullable();
            $table->dateTime('fecha_registro')->nullable();
            $table->bigInteger('cod_usuario_registro')->nullable();
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
