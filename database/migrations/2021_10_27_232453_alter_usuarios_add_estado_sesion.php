<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsuariosAddEstadoSesion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_usuarios', function (Blueprint $table) {
            $table->tinyInteger('estado_sesion')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_usuarios', function (Blueprint $table) {
            $table->dropColumn('estado_sesion')->default(1);
        });
    }
}
