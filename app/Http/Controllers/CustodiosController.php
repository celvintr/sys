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
use App\Models\TipoCustodio;
use App\Models\BitacoraCustodio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Exports\CustodiosExport;
use DB;
use PDF;
use Excel;

class CustodiosController extends Controller
{
    /**
     * Mostrar vista listado.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('dni_usuario', Auth::user()->dni_usuario)->first();
        $partidos = PartidosPoliticos::all();
        $estados = EstadoCustodio::all();
        $mostrar = request()->has('mostrar') ? request('mostrar') : 10;

        $queries = [];
        $queries['mostrar'] = $mostrar;
        $columns = ['dni_custodio', 'cod_estado', 'cod_partido'];
        $dni = request()->has($columns[0]) ? request($columns[0]) : '';
        $estado = request()->has($columns[1]) ? request($columns[1]) : '';
        $partido = '';

        if(request()->has($columns[2])) {
            $partido = request($columns[2]);
        }

        if(!is_null($user->cod_partido)) {
            $partido = $user->cod_partido;
        }

        $custodios = !is_null($user->cod_partido) ? Custodios::where('cod_partido', $user->cod_partido) : new Custodios;

        foreach($columns as $column) {
            if(request()->has($column)) {
                $custodios = $custodios->where($column, request($column));
                $queries[$column] = request($column);
            }
        }

        $totalCustodios = $custodios->count();
        $custodios = $custodios->paginate($mostrar)->appends($queries);

        $ctx = [
            'partidos' => $partidos,
            'estados' => $estados,
            'custodios' => $custodios,
            'dni' => $dni,
            'estado' => $estado,
            'partido' => $partido,
            'user' => $user,
            'total' => $totalCustodios
        ];

        return view('custodios.index', $ctx);
    }

    public function consulta()
    {
        $user = User::where('dni_usuario', Auth::user()->dni_usuario)->first();
        $partidos = PartidosPoliticos::all();
        $departamentos = Departamentos::all();
        $municipios = Municipios::where('cod_departamento', request('cod_departamento'))->get();
        $mostrar = request()->has('mostrar') ? request('mostrar') : 10;

        $queries = [];
        $queries['mostrar'] = $mostrar;
        $columns = ['cod_departamento', 'cod_municipio', 'cod_partido'];
        $departamento = request()->has($columns[0]) ? request($columns[0]) : '';
        $municipio = request()->has($columns[1]) ? request($columns[1]) : '';
        $partido = '';

        if(request()->has($columns[2])) {
            $partido = request($columns[2]);
        }

        if(!is_null($user->cod_partido)) {
            $partido = $user->cod_partido;
        }

        $custodios = !is_null($user->cod_partido) ? Custodios::where('cod_partido', $user->cod_partido) : new Custodios;

        foreach($columns as $column) {
            if(request()->has($column)) {
                $custodios = $custodios->where($column, request($column));
                $queries[$column] = request($column);
            }
        }

        $totalCustodios = $custodios->count();
        $custodios = $custodios->paginate($mostrar)->appends($queries);

        $ctx = [
            'partidos' => $partidos,
            'departamentos' => $departamentos,
            'municipios' => $municipios,
            'custodios' => $custodios,
            'departamento' => $departamento,
            'municipio' => $municipio,
            'partido' => $partido,
            'user' => $user,
            'total' => $totalCustodios
        ];

        return view('custodios.consulta', $ctx);
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
        $tiposCustodio = TipoCustodio::all();
        $user = User::where('dni_usuario', Auth::user()->dni_usuario)->first();

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
            'tiposCustodio' => $tiposCustodio,
            'user' => $user
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
            'tel_movil'          => 'required|regex:/^[0-9]{8}+$/|max:8',
            'tel_fijo'           => $request->tel_fijo != '' ? 'required|regex:/^[0-9]{8}+$/|max:8' : '',
            'correo1_custodio'   => 'required|email',
            'correo2_custodio'   => ($request->correo2_custodio != '' ? 'required|email' : ''),
            'foto_custodio'      => 'required|image',
            'foto_dni_custodio'  => 'required|image',
            'foto_comp_custodio' => 'required|image',
            'cod_departamento'   => 'required',
            'cod_municipio'      => ($request->cod_tipo_custodio == 1 ? 'required' : ''),
            'cod_partido'        => 'required',
            'cod_centro'         => ($request->cod_tipo_custodio == 1 ? 'required' : ''),
            'cod_tipo_custodio'  => 'required',
            'dir_custodio'  => 'required',
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
            'cod_departamento'      => 'Departamento',
            'cod_municipio'      => 'Municipio',
            'cod_partido'        => 'Partido político',
            'cod_centro'         => 'Centro de votación',
            'cod_tipo_custodio'  => 'Tipo de custodio',
            'dir_custodio'  => 'Dirección de custodio',
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

        // Si el tipo de custodio es diferente de custodio de transporte, entonces se valida los custodios para el centro
        if($request->cod_tipo_custodio != 2) {
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
        } else {
            // Aplicar custodios de transporte solo para partido liberal, nacional y libre
            if($request->cod_partido == 1 || $request->cod_partido == 2 || $request->cod_partido == 7) {
                // Obtenemos la cantidad de custodios de transporte en el departamento por el partido, si esto es igual a 2 ya no se puede crear mas custodios de trasporte para ese departamento.
                $cantCustodiosPartidoDepto = Custodios::where('cod_departamento', $request->cod_departamento)
                                                ->where('cod_partido', $request->cod_partido)
                                                ->where('cod_tipo_custodio', 2)
                                                ->where('cod_estado', 1)
                                                ->count();

                // Verificiar si la cantidad de custodios por partido en el departamento es igual a 2 que ya no pueda agregar mas
                if($cantCustodiosPartidoDepto == 2) {
                    return response()->json([
                        'error' => true,
                        'message' => 'No puedes crear más custodios de transporte para este departamento máximo 2/2 permitidos para el partido.'
                    ]);
                }
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'No puedes crear custodios de transporte para este partido.'
                ]);
            }
        }

        if($this->validarDNI($request->dni_custodio)) {
            return response()->json([
                'error' => true,
                'message' => 'El custodio que intentas ingresar ya se encuentra registrado, es aspirante electoral o no se encuentra habilitado en el censo nacional.'
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
                'cod_departamento'     => $request->cod_departamento,
                'cod_municipio'        => $request->cod_tipo_custodio == 1 ? $request->cod_municipio : null,
                'dir_custodio'         => $request->dir_custodio,
                'cod_partido'          => $request->cod_partido,
                'cod_centro'           => $request->cod_tipo_custodio != 1 ? null : $request->cod_centro,
                'cod_estado'           => 1,
                'cod_tipo_custodio'    => $request->cod_tipo_custodio,
                'fecha_registro'       => now(),
                'dni_usuario_registro' => Auth::user()->dni_usuario,
            ]);

            if($request->cod_tipo_custodio != 2) {
                // Formar el cod centro de votacion = cod municipio - codigo de area - cod sector - cod junta receptopra, depende del tipo de custodio
                $codCentroVotacion =  $datosCentroVotacion->cod_municipio . str_pad($datosCentroVotacion->codigo_area, 2, "0", STR_PAD_LEFT) . str_pad($datosCentroVotacion->codigo_sector_electoral, 2, "0", STR_PAD_LEFT) . str_pad($datosCentroVotacion->cod_junta_receptora, 5, "0", STR_PAD_LEFT);
            } else {
                // se le agrega el codigo del departamento, aqui es diferente el codigo de centro de votacion ya que no tenemos un centro y solamente tenemos el cod del departamento
                $codCentroVotacion = str_pad($request->cod_departamento, 13, "0", STR_PAD_LEFT);
            }

            // Recuperamos lso datos del custodio creado para crearle el cod_custodio
            $newCustodio = Custodios::find($custodio->idc_custodio);
            $newCustodio->cod_custodio = $newCustodio->cod_partido .  $codCentroVotacion . $newCustodio->idc_custodio;
            $newCustodio->save();

            $descripcion = [
                'ID CORRELATIVO CUSTODIO: ' . $newCustodio->idc_custodio,
                'COD CUSTODIO: '. $newCustodio->cod_custodio,
                'NOMBRE: ' . $newCustodio->nombre_custodio,
                'TEL MOVIL: ' . $newCustodio->tel_movil,
                'TEL FIJO: ' . ($newCustodio->tel_fijo != '' ? $newCustodio->tel_fijo : 'null'),
                'CORREO 1: ' . $newCustodio->correo1_custodio,
                'CORREO 2: ' . ($newCustodio->correo2_custodio != '' ? $newCustodio->correo2_custodio : 'null'),
                'COD DEPARTAMENTO: ' . $newCustodio->cod_departamento,
                'COD MUNICIPIO: ' . $newCustodio->cod_municipio,
                'DIRECCION: ' . $newCustodio->dir_custodio,
                'PARTIDO: ' . $newCustodio->partido->nombre_partido,
                'CENTRO DE VOTACION: ' . ($newCustodio->cod_tipo_custodio == 1 ? $newCustodio->centro->nombre_centro . ' ' . $newCustodio->centro->nombre_sector_electoral : 'null'),
                'ESTADO: ' . $newCustodio->estado->nombre_estado,
                'TIPO CUSTODIO: ' . $newCustodio->tipoCustodio->tipo_custodio,
                'FECHA REGISTRO: ' . $newCustodio->fecha_registro,
                'DNI USUARIO REGISTRO: ' . $newCustodio->dni_usuario_registro
            ];

            // Registrar bitacora
            BitacoraCustodio::create([
                'fecha_hora_bitacora' => now(),
                'dni_usuario_accion' => Auth::user()->dni_usuario,
                'dni_custodio' => $newCustodio->dni_custodio,
                'accion' => 'REGISTRO',
                'descripcion' => implode(", ", $descripcion)
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Custodio creado exitosamente'
            ]);
       } catch(Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Ocurrió un error al crear el registro, por favor intenta nuevamente.'
            ]);
       }
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


        $centrosParaCustodio = Custodios::where('cod_partido', $idPartido)->where('cod_municipio', $idMunicipio)->where('tbl_custodios.cod_tipo_custodio', 1)->where('tbl_custodios.cod_estado', 1)->get();
        // return dd($centrosParaCustodio);

        /**
         *  Crear un array para agregar los centros disponibles, es decir que si ya hay un centro con un custodio asignado con dicho partido,
         * este ya ni aparece para agregar otro custodio de se partido a ese centro. 1 custodio por partido y centro
         */
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
        try {
            $user = User::where('dni_usuario', Auth::user()->dni_usuario)->first();
            $partidos = PartidosPoliticos::all();
            $estados = EstadoCustodio::all();
            $departamentos = Departamentos::all();
            $tiposCustodio = TipoCustodio::all();
            $custodio = Custodios::find($id);
            $centros = [];
            $municipios = [];

            if($custodio->cod_tipo_custodio == 1) {
                $centros = DB::table('tbl_custodio_centro')
                            ->join('tbl_centros_votacion', 'tbl_custodio_centro.cod_centro', 'tbl_centros_votacion.cod_centro')
                            ->where('tbl_centros_votacion.cod_municipio', $custodio->cod_municipio)
                            ->where('tbl_custodio_centro.cod_partido', $custodio->cod_partido)
                            ->where('tbl_custodio_centro.tiene_custodio', true)
                            ->get();
                $municipios = Municipios::where('cod_departamento', $custodio->municipio->departamento->cod_departamento)->get();
            }

            $ctx = [
                'partidos' => $partidos,
                'estados' => $estados,
                'tiposCustodio' => $tiposCustodio,
                'departamentos' => $departamentos,
                'municipios' => $municipios,
                'centros' => $centros,
                'user' => $user,
                'custodio' => $custodio
            ];

            return view('custodios.show', $ctx);
        } catch(Exception $e) {
            $mensaje = array(
                'clase' => 'alert alert-danger',
                'mensaje' => 'Ocurrió un error al obtener los datos del Flash Report, por favor intente de nuevo'
            );

            return redirect()->action('CustodiosController@index')->with($mensaje);
        }
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
            $user = User::where('dni_usuario', Auth::user()->dni_usuario)->first();
            $partidos = PartidosPoliticos::all();
            $estados = EstadoCustodio::all();
            $departamentos = Departamentos::all();
            $tiposCustodio = TipoCustodio::all();
            $custodio = Custodios::find($id);
            $centros = [];
            $municipios = [];

            if($custodio->cod_tipo_custodio == 1) {
                $centros = DB::table('tbl_custodio_centro')
                            ->join('tbl_centros_votacion', 'tbl_custodio_centro.cod_centro', 'tbl_centros_votacion.cod_centro')
                            ->where('tbl_centros_votacion.cod_municipio', $custodio->cod_municipio)
                            ->where('tbl_custodio_centro.cod_partido', $custodio->cod_partido)
                            ->where('tbl_custodio_centro.tiene_custodio', true)
                            ->get();
                $municipios = Municipios::where('cod_departamento', $custodio->municipio->departamento->cod_departamento)->get();
            }

            $ctx = [
                'partidos' => $partidos,
                'estados' => $estados,
                'tiposCustodio' => $tiposCustodio,
                'departamentos' => $departamentos,
                'municipios' => $municipios,
                'centros' => $centros,
                'user' => $user,
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
        // Obtenemos el custodio
        $custodio = Custodios::find($id_custodio);

        $validator = Validator::make($request->all(), [
            'dni_custodio'       => 'required',
            'nombre_custodio'    => 'required|regex:/^[A-Za-z ]+$/',
            'tel_movil'          => 'required|regex:/^[0-9]{8}+$/|max:8',
            'tel_fijo'           => $request->correo2_custodio != '' ? 'required|regex:/^[0-9]{8}+$/|max:8' : '',
            'correo1_custodio'   => 'required|email',
            'correo2_custodio'   => $request->correo2_custodio != '' ? 'email' : '',
            'foto_custodio'      => !is_null($request->foto_custodio) ? 'required|image|max:5000' : '',
            'foto_dni_custodio'  => !is_null($request->foto_dni_custodio) ? 'required|image|max:5000' : '',
            'foto_comp_custodio' => !is_null($request->foto_comp_custodio) ? 'required|image|max:5000' : '',
            'cod_departamento'   => 'required',
            'cod_municipio'      => $custodio->cod_tipo_custodio != 2 ? 'required' : '',
            'cod_partido'        => 'required',
            'cod_centro'         => $custodio->cod_tipo_custodio != 2 ? 'required' : '',
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
            'cod_departamento'      => 'Departamento',
            'cod_municipio'      => 'Municipio',
            'cod_partido'        => 'Partido político',
            'cod_centro'         => 'Centro de votación',
            'cod_estado'         => 'Estado'
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all(), 'dni' => $request->dni_custodio]);
        }

        if ($request->hasFile('foto_custodio')) {
            $custodio->foto_custodio = $request->file('foto_custodio')->store('custodios', 'uploads');
        }

        if ($request->hasFile('foto_dni_custodio')) {
            $custodio->foto_dni_custodio = $request->file('foto_dni_custodio')->store('custodios', 'uploads');
        }

        if ($request->hasFile('foto_comp_custodio')) {
            $custodio->foto_comp_custodio = $request->file('foto_comp_custodio')->store('custodios', 'uploads');
        }

        // Validar si el custodio es de tipo custodio electoral para validar los cupos en el centro y partido, sino se valida por custodio de transporte
        if($custodio->cod_tipo_custodio == 1) {
            // Obtener la cantidad de custodios activos por cod de partido y con centro del registro actual, solo debe haber uno por centro
            $cantCustodiosActivos = Custodios::where('cod_partido', $request->cod_partido)->where('cod_centro', $request->cod_centro)->where('cod_estado', 1)->count();

            if($custodio->cod_estado != 1 && $request->cod_estado == 1) {
                if($cantCustodiosActivos > 0) {
                    return response()->json([
                        'error' => true,
                        'message' => 'Error, no puedes activar este custodio porque ya hay uno asignado y activo para este centro, por favor intenta de nuevo.'
                    ]);
                }
            }

            if(($request->cod_centro != $custodio->cod_centro)) {
                if($cantCustodiosActivos > 0) {
                    return response()->json([
                        'error' => true,
                        'message' => 'Error, ya hay un custodio asignado y activo para este centro de votación y partido político, por favor intenta de nuevo.'
                    ]);
                }
            }

            if(($request->cod_partido != $custodio->cod_partido)) {
                if($cantCustodiosActivos > 0) {
                    return response()->json([
                        'error' => true,
                        'message' => 'Error, ya hay un custodio asignado y activo para este partido político y centro de votación, por favor intenta de nuevo.'
                    ]);
                }
            }
        } else {
                // Validar custodios de transporte solo para patido liberal, nacional y libre
            if($request->cod_partido == 1 || $request->cod_partido == 2 || $request->cod_partido == 7) {
                // Obtenemos la cantidad de custodios para el departamento, solo deben ser 6 maximo para el departamento, 2 libre 2 partido nacional y 2 liberal
                $cantCustodiosPartidoDepto = Custodios::where('cod_departamento', $request->cod_departamento)
                                                ->where('cod_partido', $request->cod_partido)
                                                ->where('cod_tipo_custodio', 2)
                                                ->where('cod_estado', 1)
                                                ->count();

                if($custodio->cod_estado != 1 && $request->cod_estado == 1) {
                    if($cantCustodiosPartidoDepto == 2) {
                        return response()->json([
                            'error' => true,
                            'message' => 'Error, no puedes activar este custodio porque ya hay 2/2 custodios de transporte activos para este departamento y partido político, por favor intenta de nuevo.'
                        ]);
                    }
                }

                if($custodio->cod_partido != $request->cod_partido) {
                    if($cantCustodiosPartidoDepto == 2) {
                        return response()->json([
                            'error' => true,
                            'message' => 'Error, no puedes cambiar este custodio porque ya hay 2/2 custodios de transporte activos para este partido político y departamento, por favor intenta de nuevo.'
                        ]);
                    }
                }
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Este partido político no permite custodios de transporte.'
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

        if($custodio->cod_tipo_custodio != 2) {
            // Obtener datos del centro de votacion
            $datosCentroVotacion = CentrosVotacion::find($request->cod_centro);

            // Formar el cod centro de votacion = cod municipio - codigo de area - cod sector - cod junta receptopra, depende del tipo de custodio
            $codCentroVotacion =  $datosCentroVotacion->cod_municipio . str_pad($datosCentroVotacion->codigo_area, 2, "0", STR_PAD_LEFT) . str_pad($datosCentroVotacion->codigo_sector_electoral, 2, "0", STR_PAD_LEFT) . str_pad($datosCentroVotacion->cod_junta_receptora, 5, "0", STR_PAD_LEFT);
        } else {
            // se le agrega el codigo del departamento, aqui es diferente el codigo de centro de votacion ya que no tenemos un centro y solamente tenemos el cod del departamento
            $codCentroVotacion = str_pad($request->cod_departamento, 13, "0", STR_PAD_LEFT);
        }

        $codCustodio = $request->cod_partido .  $codCentroVotacion . $custodio->idc_custodio;

        try {
            // Establecer los nuevos valores
            $custodio->cod_custodio = $codCustodio;
            $custodio->dni_custodio = $request->dni_custodio;
            $custodio->nombre_custodio = $request->nombre_custodio;
            $custodio->tel_movil = $request->tel_movil;
            $custodio->tel_fijo = $request->tel_fijo;
            $custodio->correo1_custodio = $request->correo1_custodio;
            $custodio->correo2_custodio = $request->correo2_custodio;
            $custodio->cod_departamento = $request->cod_departamento;
            $custodio->cod_municipio = $custodio->cod_tipo_custodio == 2 ? null : $request->cod_municipio;
            $custodio->dir_custodio = $request->dir_custodio;
            $custodio->cod_partido = $request->cod_partido;
            $custodio->cod_centro = $custodio->cod_tipo_custodio == 2 ? null : $request->cod_centro;
            $custodio->cod_estado = $request->cod_estado;
            $custodio->save();

            $newCustodio = Custodios::find($id_custodio);

            $descripcion = [
                'ID CORRELATIVO CUSTODIO: ' . $newCustodio->idc_custodio,
                'COD CUSTODIO: '. $newCustodio->cod_custodio,
                'NOMBRE: ' . $newCustodio->nombre_custodio,
                'TEL MOVIL: ' . $newCustodio->tel_movil,
                'TEL FIJO: ' . ($newCustodio->tel_fijo != '' ? $newCustodio->tel_fijo : 'null'),
                'CORREO 1: ' . $newCustodio->correo1_custodio,
                'CORREO 2: ' . ($newCustodio->correo2_custodio != '' ? $newCustodio->correo2_custodio : 'null'),
                'COD DEPARTAMENTO: ' . $newCustodio->cod_departamento,
                'COD MUNICIPIO: ' . ($newCustodio->cod_municipio != '' ? $newCustodio->cod_municipio : 'null'),
                'DIRECCION: ' . $newCustodio->dir_custodio,
                'PARTIDO: ' . $newCustodio->partido->nombre_partido,
                'CENTRO DE VOTACION: ' . ($newCustodio->cod_tipo_custodio == 1 ? $newCustodio->centro->nombre_centro . ' ' . $newCustodio->centro->nombre_sector_electoral : 'null'),
                'ESTADO: ' . $newCustodio->estado->nombre_estado,
                'TIPO CUSTODIO: ' . $newCustodio->tipoCustodio->tipo_custodio,
                'FECHA REGISTRO: ' . $newCustodio->fecha_registro,
                'DNI USUARIO REGISTRO: ' . $newCustodio->dni_usuario_registro
            ];

            // Registrar bitacora
            BitacoraCustodio::create([
                'fecha_hora_bitacora' => now(),
                'dni_usuario_accion' => Auth::user()->dni_usuario,
                'dni_custodio' => $newCustodio->dni_custodio,
                'accion' => 'EDICION',
                'descripcion' => implode(", ", $descripcion)
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Custodio actualizado exitosamente'
            ]);
        } catch(Exception $ex) {
            return response()->json([
                'error' => true,
                'message' => 'Ocurrió un error al editar el custodio, por favor intenta de nuevo.'
            ]);
        }
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

            $descripcion = [
                'ID CORRELATIVO CUSTODIO: ' . $custodio->idc_custodio,
                'COD CUSTODIO: '. $custodio->cod_custodio,
                'NOMBRE: ' . $custodio->nombre_custodio,
                'TEL MOVIL: ' . $custodio->tel_movil,
                'TEL FIJO: ' . ($custodio->tel_fijo != '' ? $custodio->tel_fijo : 'null'),
                'CORREO 1: ' . $custodio->correo1_custodio,
                'CORREO 2: ' . ($custodio->correo2_custodio != '' ? $custodio->correo2_custodio : 'null'),
                'COD MUNICIPIO: ' . $custodio->cod_municipio,
                'DIRECCION: ' . $custodio->dir_custodio,
                'PARTIDO: ' . $custodio->partido->nombre_partido,
                'CENTRO DE VOTACION: ' . ($custodio->cod_tipo_custodio == 1 ? $custodio->centro->nombre_centro . ' ' . $custodio->centro->nombre_sector_electoral : 'null'),
                'ESTADO: ' . $custodio->estado->nombre_estado,
                'TIPO CUSTODIO: ' . $custodio->tipoCustodio->tipo_custodio,
                'FECHA REGISTRO: ' . $custodio->fecha_registro,
                'DNI USUARIO REGISTRO: ' . $custodio->dni_usuario_registro
            ];

            // Registrar bitacora
            BitacoraCustodio::create([
                'fecha_hora_bitacora' => now(),
                'dni_usuario_accion' => Auth::user()->dni_usuario,
                'dni_custodio' => $custodio->dni_custodio,
                'accion' => 'ELIMINACION',
                'descripcion' => implode(", ", $descripcion)
            ]);

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

    public function pdf($id_custodio) {
        $custodio = Custodios::find($id_custodio);
        $user = User::where('dni_usuario', Auth::user()->dni_usuario)->first();

        if(!is_null($user->cod_partido)) {
            if($custodio->cod_partido != $user->cod_partido) {
                return redirect()->route('admin.custodios.index');
            }
        }

        if(is_null($custodio)) {
            return redirect()->route('admin.custodios.index');
        }

        if($custodio->cod_estado != 1) {
            return redirect()->route('admin.custodios.index');
        }

        $ctx = ['custodio' => $custodio];
        $pdf = PDF::loadView('custodios.custodiopdf', $ctx);
        $pdf->setPaper('letter', 'letter');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $nombreArchivo = 'Comnprobante ' . $custodio->nombre_custodio . ' - Partido ' . $custodio->partido->nombre_partido . '.pdf';

        $canvas = $dom_pdf->get_canvas();
        $canvas->page_text(500, 750, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
        // return view('custodios.custodiopdf', ['custodio' => $custodio]);
        return $pdf->stream($nombreArchivo);
    }

    public function descargarExcel(Request $request){
        $user = User::where('dni_usuario', Auth::user()->dni_usuario)->first();
        $cod_partido = !is_null($user->cod_partido) ? $user->cod_partido : $request->cod_partido;
         // se obtienenn los datos
        $columns = ['dni_custodio', 'cod_estado', 'cod_partido'];

        if($request->dni_custodio != '' && $request->cod_estado == '' && $request->cod_partido == '') {
            $custodios = Custodios::where('dni_custodio', $request->dni_custodio)->get();
            $msg = 'POR DNI';
        }

        if($request->dni_custodio == '' && $request->cod_estado != '' && $request->cod_partido == '') {
            $custodios = Custodios::where('cod_estado', $request->cod_estado)->get();
            $msg = 'POR COD ESTADO';
        }

        if($request->dni_custodio == '' && $request->cod_estado == '' && $request->cod_partido != '') {
            $custodios = Custodios::where('cod_partido', $cod_partido)->get();
            $msg = 'POR COD PARTDO';
        }

        if($request->dni_custodio != '' && $request->cod_estado != '' && $request->cod_partido == '') {
            $custodios = Custodios::where('dni_custodio', $request->dni_custodio)->where('cod_estado', $request->cod_estado)->get();
            $msg = 'POR DNI y ESTADO';
        }

        if($request->dni_custodio != '' && $request->cod_estado == '' && $request->cod_partido != '') {
            $custodios = Custodios::where('dni_custodio', $request->dni_custodio)->where('cod_partido', $cod_partido)->get();
            $msg = 'POR DNI y PARTIDO';
        }

        if($request->dni_custodio == '' && $request->cod_estado != '' && $request->cod_partido != '') {
            $custodios = Custodios::where('cod_estado', $request->cod_estado)->where('cod_partido', $cod_partido)->get();
            $msg = 'POR ESTADO Y PARTIDO';
        }

        if($request->dni_custodio != '' && $request->cod_estado != '' && $request->cod_partido != '') {
            $custodios = Custodios::where('dni_custodio', $request->dni_custodio)->where('cod_estado', $request->cod_estado)->where('cod_partido', $cod_partido)->get();
            $msg = 'POR DNI, ESTADO Y PARTIDO';
        }

        if($request->dni_custodio == '' && $request->cod_estado == '' && $request->cod_partido == '') {
            $custodios = Custodios::all();
            $msg = 'POR TODO';
        }

        // Tipo de excel
        $type = 'xlsx';

        // Fecha
        $now = new \DateTime();
        $now = $now->format('d-m-Y');

        // Nombre del archivo
        $nombreArchivo = 'Custodios_' . $now . '.' . $type;

        // Retorna el archivo de excel
        return Excel::download(new CustodiosExport($custodios), $nombreArchivo);
    }

    public function descargarConsultaExcel(Request $request){
        $user = User::where('dni_usuario', Auth::user()->dni_usuario)->first();
        $cod_partido = !is_null($user->cod_partido) ? $user->cod_partido : $request->cod_partido;
        $cod_departamento = request('cod_departamento');
        $cod_municipio = request('cod_municipio');
        $custodios = Custodios::all();

        if($cod_departamento && !$cod_municipio && !$cod_partido) {
            $custodios = Custodios::where('cod_departamento', $cod_departamento)->get();
        }

        if($cod_departamento && $cod_municipio && !$cod_partido) {
            $custodios = Custodios::where('cod_departamento', $cod_departamento)->where('cod_municipio', $cod_municipio)->get();
        }

        if($cod_departamento && !$cod_municipio && $cod_partido) {
            $custodios = Custodios::where('cod_departamento', $cod_departamento)->where('cod_partido', $cod_partido)->get();
        }

        if(!$cod_departamento && $cod_municipio && !$cod_partido) {
            $custodios = Custodios::where('cod_municipio', $cod_municipio)->get();
        }

        if(!$cod_departamento && $cod_municipio && $cod_partido) {
            $custodios = Custodios::where('cod_municipio', $cod_municipio)->where('cod_partido', $cod_partido)->get();
        }

        if(!$cod_departamento && !$cod_municipio && $cod_partido) {
            $custodios = Custodios::where('cod_partido', $cod_partido)->get();
        }

        if($cod_departamento && $cod_municipio && $cod_partido) {
            $custodios = Custodios::where('cod_departamento', $cod_departamento)->where('cod_municipio', $cod_municipio)->where('cod_partido', $cod_partido)->get();
        }

        // Tipo de excel
        $type = 'xlsx';

        // Fecha
        $now = new \DateTime();
        $now = $now->format('d-m-Y');

        // Nombre del archivo
        $nombreArchivo = 'Custodios_' . $now . '.' . $type;

        // Retorna el archivo de excel
        return Excel::download(new CustodiosExport($custodios), $nombreArchivo);
    }

    /**
     * Mostrar vista listado.
     *
     * @return \Illuminate\Http\Response
     */
    public function incidencias()
    {
        $user = User::where('dni_usuario', Auth::user()->dni_usuario)->first();
        $partidos = PartidosPoliticos::all();
        $estados = EstadoCustodio::all();
        $mostrar = request()->has('mostrar') ? request('mostrar') : 10;

        $queries = [];
        $queries['mostrar'] = $mostrar;
        $columns = ['dni_custodio', 'cod_estado', 'cod_partido'];
        $dni = request()->has($columns[0]) ? request($columns[0]) : '';
        $estado = request()->has($columns[1]) ? request($columns[1]) : '';
        $partido = '';

        if(request()->has($columns[2])) {
            $partido = request($columns[2]);
        }

        if(!is_null($user->cod_partido)) {
            $partido = $user->cod_partido;
        }

        $custodios = !is_null($user->cod_partido) ? Custodios::where('cod_partido', $user->cod_partido) : new Custodios;

        foreach($columns as $column) {
            if(request()->has($column)) {
                $custodios = $custodios->where($column, request($column));
                $queries[$column] = request($column);
            }
        }
        $custodios = $custodios->where('cod_estado', 1);
        $custodios = $custodios->where('hoja_incidencia', 1);

        $totalCustodios = $custodios->count();
        $custodios = $custodios->paginate($mostrar)->appends($queries);

        $ctx = [
            'partidos' => $partidos,
            'estados' => $estados,
            'custodios' => $custodios,
            'dni' => $dni,
            'estado' => $estado,
            'partido' => $partido,
            'user' => $user,
            'total' => $totalCustodios
        ];

        return view('custodios.incidencias', $ctx);
    }

    /**
     * Mostrar hoja
     */
    public function incidencias_pdf($idc_custodio)
    {
        $custodio = Custodios::find($idc_custodio);

        $data = DB::table('tbl_resp')
            ->select('tbl_preg.id', 'tbl_preg.pregunta', 'tbl_resp.respuesta')
            ->join('tbl_preg', 'tbl_preg.cod_preg', '=', 'tbl_resp.cod_preg')
            ->orderBy('id', 'asc')
            ->get();

        $pdf = PDF::loadView('custodios.hoja_incidencia_pdf', [
            'data' => $data,
            'custodio' => $custodio,
        ]);
        return $pdf->stream('hoja_incidencia_' . $custodio->dni_custodio . '.pdf');
    }
}
