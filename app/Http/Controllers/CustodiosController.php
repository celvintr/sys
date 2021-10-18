<?php

namespace App\Http\Controllers;

use App\Models\Custodios;
use App\Models\Departamentos;
use App\Models\DNI;
use Illuminate\Http\Request;

class CustodiosController extends Controller
{
    /**
     * Mostrar vista listado.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('custodios.index');
    }

    /**
     * Obtener data para el listado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        $custodios = Custodios::all();

        return response()->json($custodios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = null;
        $departamentos = Departamentos::all();

        if (session()->has('dni')) {
            $form = (object) [
                'dni_custodio'    => session('dni')['dni_custodio'],
                'nombre_custodio' => session('dni')['nombre_custodio'],
            ];
        }

        return view('custodios.create', [
            'form'          => $form,
            'departamentos' => $departamentos,
        ]);
    }

    /**
     * Buscar DNI
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dni(Request $request)
    {
        if (!empty($request->dni)) {
            $data = DNI::where('dni_custodio', $request->dni)->first();
            if (empty($data->dni_custodio)) {
                $request->session()->flash('dni_error', "No se encontro este DNI en la base de datos.");
            } else {
                $request->session()->flash('dni', $data);
            }
        } else {
            $request->session()->flash('dni_error', "Debe agregar un DNI a buscar.");
        }

        return redirect()->route('admin.custodios.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
