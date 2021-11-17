<?php

namespace App\Http\Controllers;

use App\Models\Custodios;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Departamentos;
use App\Models\DNI;
use App\Models\CensoAspirante;
use App\Models\CensoNacional;
use App\Models\PartidosPoliticos;
use App\Models\EstadoCustodio;
use App\Models\Municipios;
use App\Models\CentrosVotacion;
use App\Models\CustodioCentro;
use App\Models\TipoCustodio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
class IncidenciasController extends Controller
{

    /**
     * Buscar DNI.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dni(Request $request)
    {
        // $fecha_nacimiento = Carbon::createFromFormat('d/m/Y', $request->fecha_nacimiento)->format('Y-m-d');
        // dd($fecha_nacimiento);

        $validated = $request->validate([
            'dni_custodio'      => 'required',
            'fecha_nacimiento' => 'required|date_format:d/m/Y',
        ], [], [
            'dni_custodio'      => 'DNI Custodio',
            'fecha_nacimiento' => 'Fecha de nacimiento',
        ]);

        $custodio = Custodios::where('dni_custodio', $request->dni_custodio)->first();
        if (empty($custodio->dni_custodio)) {
            throw ValidationException::withMessages([
                'dni_custodio' => 'DNI no encontrado',
            ]);
        }
        elseif ($custodio->hoja_incidencia == 1) {
            throw ValidationException::withMessages([
                'dni_custodio' => 'Incidencias ya enviada',
            ]);
        }
        //  esta linea va a ser sustituida por la consulta en el campo de fecha OJO
        //  aqui me imaginocs vamos a validar que la fecha este en el registro que conicida con el DNI es temporal esto aqui...
        elseif ($request->fecha_nacimiento != $custodio->fecha_nacimiento->format('d/m/Y')) {
            throw ValidationException::withMessages([
                'fecha_nacimiento' => 'Fecha de nacimiento no coincide',
            ]);
        }

        session(['custodio' => $custodio]);



        return redirect()->route('incidencias.form');
    }

    /**
     * Form incidencias.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        if (!session()->has('custodio')) {
            return redirect()->route('login');
        }

        $custodio = session('custodio');
        $preguntas = DB::table('tbl_preg')->orderBy('id', 'asc')->get();
        return view('incidencias.form', compact('custodio','preguntas'));
    }

    /**
     * Guardar incidencias.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        foreach ($request->group as $key => $value) {
            DB::table('tbl_resp')->insert([
                'idc_custodio' => $request->idc_custodio,
                'cod_preg'     => $key,
                'respuesta'    => is_array($value) ? json_encode($value) : $value,
            ]);
        }

        Custodios::where('idc_custodio', $request->idc_custodio)->update([
            'hoja_incidencia' => 1,
        ]);

        $request->session()->flash('status', 'Incidencias enviada');

        return redirect()->route('login');
    }
}
