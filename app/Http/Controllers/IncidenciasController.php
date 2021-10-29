<?php

namespace App\Http\Controllers;

use App\Models\Custodios;
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
        $validated = $request->validate([
            'dni_custodio' => 'required',
        ], [], [
            'dni_custodio' => 'DNI Custodio',
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

        $request->session()->flash('dni_custodio', $custodio->dni_custodio);

        return redirect()->route('incidencias.form');
    }

    /**
     * Form incidencias.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        if (!session()->has('dni_custodio') && !old('dni_custodio')) {
            return redirect()->route('login');
        }

        $dni_custodio = (session()->has('dni_custodio') ? session('dni_custodio') : old('dni_custodio'));

        $custodio = Custodios::where('dni_custodio', $dni_custodio)->firstOrFail();

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
