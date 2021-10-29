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
        $request->fechanac_custodio = Carbon::createFromFormat('d/m/Y', $request->fechanac_custodio)->format('Y-m-d');

        $validated = $request->validate([
            'dni_custodio'      => 'required',
            'fechanac_custodio' => 'required|date',
        ], [], [
            'dni_custodio'      => 'DNI Custodio',
            'fechanac_custodio' => 'Fecha de nacimiento',
        ]);

        $custodio = Custodios::where('dni_custodio', $request->dni_custodio)->first();
        if (empty($custodio->dni_custodio)) {
            throw ValidationException::withMessages([
                'dni_custodio' => 'DNI no encontrado',
            ]);
        }
        elseif ($custodio->estado == 1) {
            throw ValidationException::withMessages([
                'dni_custodio' => 'Incidencias ya enviada',
            ]);
        }
        //  esta linea va a ser sustituida por la consulta en el campo de fecha OJO
        elseif ($request->fechanac_custodio != now()->format('Y-m-d')) {
            throw ValidationException::withMessages([
                'fechanac_custodio' => 'Validación falló',
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
            'nombre_custodio'  => $request->nombre_custodio,
            'correo1_custodio' => $request->correo1_custodio,
            'tel_movil'        => $request->tel_movil,
            'estado'           => 1,
        ]);

        $request->session()->flash('status', 'Incidencias enviada');

        return redirect()->route('login');
    }
}
