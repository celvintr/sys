<?php

namespace App\Http\Controllers;

use App\Models\Custodios;
use App\Models\Departamentos;
use App\Models\DNI;
use App\Models\CensoAspirante;
use App\Models\CensoNacional;
use App\Models\PartidosPoliticos;
use App\Models\EstadoCustodio;
use App\Models\Municipios;
use App\Models\CentrosVotacion;
use App\Models\CustodioCentro;
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
        $partidos = PartidosPoliticos::all();
        $estados = EstadoCustodio::all();
        $mostrar = request()->has('mostrar') ? request('mostrar') : 10;

        $queries = [];
        $queries['mostrar'] = $mostrar;
        $columns = ['dni_custodio', 'cod_estado', 'cod_partido'];
        $custodios = new Custodios;

        foreach($columns as $column) {
            if(request()->has($column)) {
                $custodios = $custodios->where($column, request($column));
                $queries[$column] = request($column);
            }
        }

        $custodios = $custodios->paginate($mostrar)->appends($queries);
        
        $ctx = [
            'partidos' => $partidos,
            'estados' => $estados,
            'custodios' => $custodios
        ];
        
        return view('custodios.index', $ctx);
    }

    /**
     * Obtener data para el listado.
     * 5735
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        $custodios = DB::table('tbl_custodios')
                        ->join('tbl_estados_custodios', 'tbl_custodios.cod_estado', 'tbl_estados_custodios.cod_estado')
                        ->join('tbl_partidos_politicos', 'tbl_custodios.cod_partido', 'tbl_partidos_politicos.cod_partido')
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
            'tel_fijo'           => $request->correo2_custodio != '' ? 'required|regex:/^[0-9]+$/|max:8' : '',
            'correo1_custodio'   => 'required|email',
            'correo2_custodio'   => $request->correo2_custodio != '' ? 'email' : '',
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

        // Obtener datos del centro de votacion
        $datosCentroVotacion = CentrosVotacion::find($request->cod_centro);

        // Obtener cuantos custodios activos hay en el centro, deben ser maximo 5 custodios
        $cantCustodiosEnElCentro = Custodios::where('cod_centro', $request->cod_centro)->where('cod_estado', 1)->count();

        if($cantCustodiosEnElCentro > $datosCentroVotacion->cant_custodios) {
            return response()->json([
                'error' => true,
                'message' => 'No puedes crear más custodios para este centro. El centro de votación tiene ' . $cantCustodiosEnElCentro . '/' . $datosCentroVotacion->cant_custodios . ' permitidos.'
            ]);
        }

        // Obtener la cantidad de custodios activos por cod de partido y con centro del registro actual, solo debe haber uno por centro.
        $cantCustodiosActivos = Custodios::where('cod_partido', $request->cod_partido)->where('cod_centro', $request->cod_centro)->where('cod_estado', 1)->count();
        
        if($cantCustodiosActivos > 0) {
            return response()->json([
                'error' => true,
                'message' => 'No puedes crear más custodios para este centro.'
            ]);
        }

        if($this->validarDNI($request->dni_custodio)) {
            return response()->json([
                'error' => true,
                'message' => 'El custodio que intentas ingresar ya se encuentra registrado, es aspirante electoral o no se encuentra en el censo nacional.'
            ]);
        }

        try {
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

            // Formar el cod centro de votacion = cod municipio - codigo de area - cod sector - cod junta receptopra
            $codCentroVotacion =  $datosCentroVotacion->cod_municipio . str_pad($datosCentroVotacion->codigo_area, 2, "0", STR_PAD_LEFT) . str_pad($datosCentroVotacion->codigo_sector_electoral, 2, "0", STR_PAD_LEFT) . str_pad($datosCentroVotacion->cod_junta_receptora, 5, "0", STR_PAD_LEFT);

            // Recuperamos lso datos del custodio creado para crearle el cod_custodio
            $newCustodio = Custodios::find($custodio->idc_custodio);
            $newCustodio->cod_custodio = $newCustodio->cod_partido .  $codCentroVotacion . $newCustodio->idc_custodio;
            $newCustodio->save();

            return response()->json([
                'error' => false,
                'message' => 'Custodio creado exitosamente',
                'datos' => $datosCentroVotacion
            ]);
       } catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Ocurrió un error al crear el registro, por favor intenta nuevamente.'
            ]);
       }

        // $custodio_aspirante = CensoAspirante::where('dni', $newCustodio->dni_custodio)->where('es_aspirante', true)->first();
        
        // if(!is_null($custodio_aspirante)) {
        //     $newCustodio->cod_estado = 3;
        //     $newCustodio->save();
        // }
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
                $data = CensoNacional::where('dni', $request->dni)->where('habilitado', true)->first();
                
                if (is_null($data)) {
                    $request->session()->flash('dni_error', "No se encontró este DNI en el censo nacional.");
                } else {
                    if($data->habilitado) {
                        $request->session()->flash('dni', $data);
                    } else {
                        $request->session()->flash('dni_error', "El custodio que intentas ingresar se encuentra inhabilitado.");
                    }
                }
            } else {
                $request->session()->flash('dni_error', "El custodio que intentas ingresar ya se encuentra registrado.");
            }
        } else {
            $request->session()->flash('dni_error', "Debe agregar un DNI a buscar.");
        }

        $request->session()->flash('dni_numero', $request->dni);


        return redirect()->route('admin.custodios.create');
    }
    
    /**
     * Esta funcion valida si existe ese DNI en el censo nacional y esta habilitado, si es aspirante electoral o ya esta registrado como custodio
     */
    private function validarDNI($dni) {
        $custodio_registrado = Custodios::where('dni_custodio', $dni)->first();

        if(!is_null($custodio_registrado)) {
            return true;
        }

        $exist_censo = CensoNacional::where('dni', $dni)->where('habilitado', true)->first();

        if(is_null($exist_censo)) {
            return true;
        }

        return false;
    }

    public function getCentros($idMunicipio, $idPartido) {
        $centros = DB::table('tbl_custodio_centro')
                    ->join('tbl_centros_votacion', 'tbl_custodio_centro.cod_centro', 'tbl_centros_votacion.cod_centro')
                    ->where('tbl_centros_votacion.cod_municipio', $idMunicipio)
                    ->where('tbl_custodio_centro.cod_partido', $idPartido)
                    ->where('tbl_custodio_centro.tiene_custodio', true)
                    ->get();
                    

        $centrosParaCustodio = Custodios::where('cod_partido', $idPartido)->where('cod_municipio', $idMunicipio)->get();

        // Crear un array para agregar los centros disponibles, es decir que si ya hay un centro con un custodio asignado con dicho partido, este ya ni aparece para agregar otro custodio de se partido a ese centro. 1 custodio por partido y centro
        $centrosDisponibles = [];

        if(count($centrosParaCustodio) > 0) {
            foreach($centros as $index => $centro) {
                foreach($centrosParaCustodio as $cc) {
                    if($centro->cod_centro != $cc->cod_centro) {
                        array_push($centrosDisponibles, $centro);
                    }
                }
            }

            return response()->json($centrosDisponibles);
        } else {
            return response()->json($centros);
        }
        
       
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
        try {
            $partidos = PartidosPoliticos::all();
            $estados = EstadoCustodio::all();
            $departamentos = Departamentos::all();
            $custodio = Custodios::find($id);
            $centros = CentrosVotacion::where('cod_municipio', $custodio->cod_municipio)->get();
            $municipios = Municipios::where('cod_departamento', $custodio->municipio->departamento->cod_departamento)->get();

            $ctx = [
                'partidos' => $partidos,
                'estados' => $estados,
                'departamentos' => $departamentos,
                'municipios' => $municipios,
                'centros' => $centros,
                'custodio' => $custodio
            ];
    
            return view('custodios.edit', $ctx);
        } catch(Exception $e) {
            $mensaje = array(
                'clase' => 'alert alert-danger',
                'mensaje' => 'Ocurrió un error al obtener los datos del Flash Report, por favor intente de nuevo'
            );

            return redirect()->action('CustodiosController@index')->with($mensaje);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_custodio)
    {
        $validator = Validator::make($request->all(), [
            'dni_custodio'       => 'required',
            'nombre_custodio'    => 'required|regex:/^[A-Za-z ]+$/',
            'tel_movil'          => 'required|regex:/^[0-9]+$/|max:8',
            'tel_fijo'           => $request->correo2_custodio != '' ? 'required|regex:/^[0-9]+$/|max:8' : '',
            'correo1_custodio'   => 'required|email',
            'correo2_custodio'   => $request->correo2_custodio != '' ? 'email' : '',
            'foto_custodio'      => !is_null($request->foto_custodio) ? 'required|image|max:5000' : '',
            'foto_dni_custodio'  => !is_null($request->foto_dni_custodio) ? 'required|image|max:5000' : '',
            'foto_comp_custodio' => !is_null($request->foto_comp_custodio) ? 'required|image|max:5000' : '',
            'cod_municipio'      => 'required',
            'cod_partido'        => 'required',
            'cod_centro'         => 'required',
            'cod_estado'         => 'required',
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
            'cod_estado'         => 'Estado',
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all(), 'dni' => $request->dni_custodio]);
        }

        // Obtenemos el custodio
        $custodio = Custodios::find($id_custodio);

        if ($request->hasFile('foto_custodio')) {
            $custodio->foto_custodio = $request->file('foto_custodio')->store('custodios', 'uploads');
        }

        if ($request->hasFile('foto_dni_custodio')) {
            $custodio->foto_dni_custodio = $request->file('foto_dni_custodio')->store('custodios', 'uploads');
        }

        if ($request->hasFile('foto_comp_custodio')) {
            $custodio->foto_comp_custodio = $request->file('foto_comp_custodio')->store('custodios', 'uploads');
        }

        // Obtener la cantidad de custodios activos por cod de partido y con centro del registro actual, solo debe haber uno por centro
        $cantCustodiosActivos = Custodios::where('cod_partido', $request->cod_partido)->where('cod_centro', $request->cod_centro)->where('cod_estado', 1)->count();

        if($custodio->cod_estado != 1) {
            if($cantCustodiosActivos > 0) {
                return response()->json([
                    'error' => true,
                    'message' => 'Error, no puedes activar este custodio porque ya hay uno asignado y activo para este centro, por favor intenta de nuevo.'
                ]);
            }
        }
        
        if($request->cod_centro != $custodio->cod_centro) {
            if($cantCustodiosActivos > 0) {
                return response()->json([
                    'error' => true,
                    'message' => 'Error, ya hay un custodio asignado para este centro, por favor intenta de nuevo.'
                ]);
            }
        }

        if($request->dni_custodio != $custodio->dni_custodio) {
            if($this->validarDNI($request->dni_custodio)) {
                return response()->json([
                    'error' => true,
                    'message' => 'El custodio que intentas ingresar ya se encuentra registrado, es aspirante electoral o no se encuentra en el censo nacional.'
                ]);
            }
        }

        $custodio->dni_custodio = $request->dni_custodio;
        $custodio->nombre_custodio = $request->nombre_custodio;
        $custodio->tel_movil = $request->tel_movil;
        $custodio->tel_fijo = $request->tel_fijo;
        $custodio->correo1_custodio = $request->correo1_custodio;
        $custodio->correo2_custodio = $request->correo2_custodio;
        $custodio->cod_municipio = $request->cod_municipio;
        $custodio->dir_custodio = $request->dir_custodio;
        $custodio->cod_partido = $request->cod_partido;
        $custodio->cod_centro = $request->cod_centro;
        $custodio->cod_estado = $request->cod_estado;
        $custodio->save();

        return response()->json([
            'error' => false,
            'message' => 'Custodio actualizado exitosamente',
            'foto' => $request->foto_dni_custodio
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_custodio)
    {
        try {
            $custodio = Custodios::find($id_custodio);
            $custodio->delete();

            return response()->json([
                'error' => false,
                'message' => 'Custodio eliminado satisfactoriamente'
            ]);
        } catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Ocurrió un error al tratar de eliminar el custodio, por favor intenta de nuevo'
            ]);
        }
    }
}
