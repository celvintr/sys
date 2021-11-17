<?php

namespace App\Http\Controllers;

use App\Models\Custodios;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

        $preguntas = DB::table('tbl_preg')->get();

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

        return view('incidencias.form', compact('custodio'));
    }

    /**
     * Guardar incidencias.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        $validated = $request->validate([
            'dni_custodio'     => 'required',
            'nombre_custodio'  => 'required',
            'correo1_custodio' => 'required',
            'tel_movil'        => 'required',
        ], [], [
            'dni_custodio'     => 'DNI Custodio',
            'nombre_custodio'  => 'Nombre',
            'correo1_custodio' => 'Correo',
            'tel_movil'        => 'Número de teléfono',
        ]);

        Custodios::where('dni_custodio', $request->dni_custodio)->update([
        //
            'hoja_incidencia'           => 1,
        ]);

        $request->session()->flash('status', 'Incidencias enviada');

        return redirect()->route('login');
    }
}
