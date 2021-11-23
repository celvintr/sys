<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Auth;
class CustodiosFaltantes extends Controller
{
    public function index(){
        if(Auth::user()->rol[0]->id !=2) {
            return redirect('/');
        }

        return view('custodios.faltantes');
    }


    public function data(){
        if(Auth::user()->rol[0]->id !=2 ) {
            return redirect('/');
        }

        $cdp=Auth::user()->cod_partido;
        $faltantes = DB :: select("select cv.COD_CENTRO, CODIGO_AREA, CODIGO_SECTOR_ELECTORAL, NOMBRE_SECTOR_ELECTORAL,COD_JUNTA_RECEPTORA, nombre_municipio, nombre_departamento
        from tbl_custodio_centro nn, tbl_centros_votacion cv, tbl_departamentos d, tbl_municipios m
        where substr (cv.cod_municipio,1,2 ) = d.cod_departamento 
        and cv.cod_municipio = m.cod_municipio 
        and nn.cod_centro = cv.cod_centro
        and nn.tiene_custodio='1'
        and nn.cod_partido = '${cdp}'
        and cv.cod_centro  not in (select c.cod_centro
                                     from tbl_custodios c 
                                     where c.cod_centro = cv.cod_centro
                                     and cod_estado = 1
                                     and cod_partido = '${cdp}'
                                     )
        order by cv.cod_centro");
        return response()->json($faltantes);
       
    }


    public function exportExcel(Request $request)
    {
        return Excel::download(new UsuariosExport($request->all()), 'usuarios.xlsx');
    }


}
