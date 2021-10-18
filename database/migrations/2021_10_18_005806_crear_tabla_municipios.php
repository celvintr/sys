<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaMunicipios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_municipios', function (Blueprint $table) {
            $table->string('cod_municipio', 4);
            $table->text('nombre_municipio');
            $table->string('cod_departamento', 2);
            $table->primary('cod_municipio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_municipios');
    }
}
