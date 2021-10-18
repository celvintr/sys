<?php

namespace App\Http\Controllers;

use App\Models\Municipios;
use Illuminate\Http\Request;

class DepartamentosController extends Controller
{
    /**
     * Municipios del departamento.
     *
     * @param  int  $cod_departamento
     * @return \Illuminate\Http\Response
     */
    public function municipios($cod_departamento)
    {
        $municipios = Municipios::where('cod_departamento', $cod_departamento)->get();

        return response()->json($municipios);
    }
}
