<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCustodios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_custodios', function (Blueprint $table) {
            $table->bigIncrements('cod_custodio');
            $table->string('dni_custodio', 13)->unique();
            $table->text('nombre_custodio');
            $table->string('tel_movil', 25)->nullable();
            $table->string('tel_fijo', 25)->nullable();
            $table->string('correo1_custodio', 50)->nullable();
            $table->string('correo2_custodio', 50)->nullable();
            $table->text('foto_custodio')->nullable();
            $table->text('foto_dni_custodio')->nullable();
            $table->text('foto_comp_custodio')->nullable();
            $table->bigInteger('cod_municipio')->nullable();
            $table->text('dir_custodio')->nullable();
            $table->bigInteger('cod_partido')->nullable();
            $table->bigInteger('cod_centro')->nullable();
            $table->bigInteger('estado_custodio')->nullable();
            $table->dateTime('fecha_registro')->nullable();
            $table->bigInteger('cod_usuario_registro')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_custodios');
    }
}
