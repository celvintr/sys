<?php

namespace App\Http\Controllers;

use App\Models\Custodios;
use App\Models\Departamentos;
use App\Models\DNI;
use App\Models\CensoAspirante;
use App\Models\CensoNacional;
use App\Models\PartidosPoliticos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

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
        $custodios = DB::table('tbl_custodios')
                        ->join('tbl_estados_custodios', 'tbl_custodios.cod_estado', 'tbl_estados_custodios.cod_estado')
                        ->get();
        
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
        $partidos = PartidosPoliticos::all();

        if (session()->has('dni')) {
            $form = (object) [
                'dni_custodio'    => session('dni')['dni'],
                'nombre_custodio' => session('dni')['nombre'],
            ];
        }

        return view('custodios.create', [
            'form'          => $form,
            'departamentos' => $departamentos,
            'partidos'      => $partidos,
        ]);
    }

    /**
     * Guardar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dni_custodio'       => 'required',
            'nombre_custodio'    => 'required|regex:/^[A-Za-z ]+$/',
            'tel_movil'          => 'required|regex:/^[0-9]+$/|max:8',
            'tel_fijo'          => 'required|regex:/^[0-9]+$/|max:8',
            'correo1_custodio'   => 'required|email',
            'correo2_custodio'   => 'email',
            'foto_custodio'      => 'required|image',
            'foto_dni_custodio'  => 'required|image',
            'foto_comp_custodio' => 'required|image',
            'cod_municipio'      => 'required',
            'cod_partido'        => 'required',
            'cod_centro'         => 'required',
        ], [], [
            'dni_custodio'       => 'DNI',
            'nombre_custodio'    => 'Nombre',
            'tel_movil'          => 'Teléfono movil',
            'tel_fijo'          => 'Teléfono fijo',
            'correo1_custodio'   => 'Correo #1',
            'correo2_custodio'   => 'Correo #2',
            'foto_custodio'      => 'Foto',
            'foto_dni_custodio'  => 'Foto DNI',
            'foto_comp_custodio' => 'Foto comp.',
            'cod_municipio'      => 'Municipio',
            'cod_partido'        => 'Partido político',
            'cod_centro'         => 'Centro de votación',
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $foto_custodio = null;
        if ($request->hasFile('foto_custodio')) {
            $foto_custodio = $request->file('foto_custodio')->store('custodios', 'uploads');
        }

        $foto_dni_custodio = null;
        if ($request->hasFile('foto_dni_custodio')) {
            $foto_dni_custodio = $request->file('foto_dni_custodio')->store('custodios', 'uploads');
        }

        $foto_comp_custodio = null;
        if ($request->hasFile('foto_comp_custodio')) {
            $foto_comp_custodio = $request->file('foto_comp_custodio')->store('custodios', 'uploads');
        }

        $custodio = Custodios::create([
            'dni_custodio'         => $request->dni_custodio,
            'nombre_custodio'      => $request->nombre_custodio,
            'tel_movil'            => $request->tel_movil,
            'tel_fijo'             => $request->tel_fijo,
            'correo1_custodio'     => $request->correo1_custodio,
            'correo2_custodio'     => $request->correo2_custodio,
            'foto_custodio'        => $foto_custodio,
            'foto_dni_custodio'    => $foto_dni_custodio,
            'foto_comp_custodio'   => $foto_comp_custodio,
            'cod_municipio'        => $request->cod_municipio,
            'dir_custodio'         => $request->dir_custodio,
            'cod_partido'          => $request->cod_partido,
            'cod_centro'           => $request->cod_centro,
            'cod_estado'           => 1,
            'fecha_registro'       => now(),
            'dni_usuario_registro' => Auth::user()->dni_usuario,
        ]);

        $newCustodio = Custodios::find($custodio->idc_custodio);
        $newCustodio->cod_custodio = $newCustodio->cod_partido .  $newCustodio->cod_municipio . str_pad($newCustodio->cod_centro, 4, "0", STR_PAD_LEFT) . $newCustodio->idc_custodio;
        $newCustodio->save();

        $custodio_aspirante = CensoAspirante::where('dni', $newCustodio->dni_custodio)->first();
        
        if(!is_null($custodio_aspirante)) {
            $newCustodio->cod_estado = 3;
            $newCustodio->save();
        }

        return response()->json(['success' => 'Custodio creado exitosamente']);
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
            $custodio_registrado = Custodios::where('dni_custodio', $request->dni)->first();

            if(empty($custodio_registrado)) {
                $data = CensoNacional::where('dni', $request->dni)->first();
               
                if (empty($data->dni)) {
                    $request->session()->flash('dni_error', "No se encontró este DNI en el censo nacional.");
                } else {
                    $request->session()->flash('dni', $data);
                }
            } else {
                $request->session()->flash('dni_error', "El custodio que intentas ingresar ya se encuentra registrado.");
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
