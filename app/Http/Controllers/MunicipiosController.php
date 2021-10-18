<?php

namespace App\Http\Controllers;

use App\Models\CentrosVotacion;
use Illuminate\Http\Request;

class MunicipiosController extends Controller
{
    /**
     * Centros de votacion del municipio.
     *
     * @param  int  $cod_municipio
     * @return \Illuminate\Http\Response
     */
    public function centros($cod_municipio)
    {
        $centros = CentrosVotacion::where('cod_municipio', $cod_municipio)->get();

        return response()->json($centros);
    }
}
