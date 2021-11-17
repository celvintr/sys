<x-app-layout>
    <x-slot name="header">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"> Hojas de Incidencias </h5>
    </x-slot>

    <div class="row">
        <div class="col-md-12">
            @if(session('mensaje'))
                <div class="{{ session('clase') }}" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('mensaje') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">
                            Hojas de incidencias
                            <span class="d-block text-muted pt-2 font-size-sm">Módulo para ver las hojas de incidencias de los custodios</span>
                        </h3>
                    </div>

                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ route('admin.custodios.index') }}" class="btn btn-secondary font-weight-bolder mr-2">Limpiar filtros</a>
                        <!--end::Button-->
                    </div>
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="card-body">
                    <!--begin: Datatable-->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-icon">
                                <input type="text" class="form-control" placeholder="Search DNI..." id="input-dni" value="{{ request()->has('dni_custodio') ? request('dni_custodio') : ''   }}">
                                <span><i class="flaticon2-search-1 text-muted"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <label class="mr-3 mb-0 d-none d-md-block">Partido Político:</label>
                                <select class="form-control  kt-selectpicker" id="cbo-partido" tabindex="null" @if(!is_null($user->cod_partido)) disabled @endif>
                                    @if(!empty($partidos))
                                        @if(!is_null($user->cod_partido))
                                            @foreach($partidos as $partido)
                                                @if($partido->cod_partido == $user->cod_partido)
                                                    <option value="{{ $partido->cod_partido }}" selected>{{ $partido->nombre_partido }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="">Todos</option>
                                            @foreach($partidos as $partido)
                                                <option value="{{ $partido->cod_partido }}" @if(request()->has('cod_partido') && request('cod_partido') == $partido->cod_partido) selected @endif>{{ $partido->nombre_partido }}</option>
                                            @endforeach
                                        @endif
                                    @else
                                        <option value="">No hay opciones</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <label class="mr-3 mb-0 d-none d-md-block">Estado:</label>
                                <select class="form-control  kt-selectpicker" id="cbo-estado" tabindex="null">
                                    <option value="">Todos</option>
                                    @if(!empty($estados))
                                        @foreach($estados as $estado)
                                            <option value="{{ $estado->cod_estado }}" @if(request()->has('cod_estado') && request('cod_estado') == $estado->cod_estado) selected @endif>{{ $estado->nombre_estado }}</option>
                                        @endforeach
                                    @else
                                        <option value="">No hay opciones</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="datatable-bordered datatable-head-custom" id="table_custodios">
                        <div class="table-responsive">
                            <input type="hidden" id="url" value="{{ route('admin.custodios.index') }}" />
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>COD CUSTODIO</th>
                                        <th>CUSTODIO</th>
                                        <th>TELÉFONO</th>
                                        <th>CORREO</th>
                                        <th class="text-center">MÁS</th>
                                        <th class="text-center">ESTADO</th>
                                        <th class="text-center">ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($custodios) > 0)
                                        @foreach($custodios as $custodio)
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bolder">{{ $custodio->cod_custodio }}</span>
                                                </td>
                                                <td>
                                                    <span style="width: 134px;">
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                                                <img class="" src="{{  $custodio->avatar }}" alt="photo">
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">{{ $custodio->nombre_custodio }}</div>
                                                                <p class="text-muted font-weight-bold text-hover-primary">DNI: {{ $custodio->dni_custodio }}</p>
                                                            </div>
                                                        </div>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center" style="gap: 5px;">
                                                        <i class="fas fa-mobile-alt"></i>
                                                        <a href="tel:${data.tel_movil}" class="text-muted font-weight-bold text-hover-primary">{{ $custodio->tel_movil }}</a>
                                                    </div>
                                                    @if(!is_null($custodio->tel_fijo))
                                                    <div class="d-flex align-items-center" style="gap: 5px;">
                                                        <i class="fas fa-phone-alt"></i>
                                                        <a href="tel:${data.tel_fijo}" class="text-muted font-weight-bold text-hover-primary">{{ $custodio->tel_fijo }}</a>
                                                    </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center" style="gap: 5px;">
                                                        <i class="far fa-envelope"></i>
                                                        <a href="mailto:${data.correo1_custodio}" class="text-muted font-weight-bold text-hover-primary">{{ $custodio->correo1_custodio }}</a>
                                                    </div>
                                                    @if(!is_null($custodio->correo2_custodio))
                                                    <div class="d-flex align-items-center" style="gap: 5px;">
                                                        <i class="far fa-envelope"></i>
                                                        <a href="mailto:${data.correo2_custodio}" class="text-muted font-weight-bold text-hover-primary">{{ $custodio->correo2_custodio }}</a>
                                                    </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="ml-4">
                                                            @if($custodio->cod_tipo_custodio == 1)
                                                            <p class="text-muted font-weight-bold text-hover-primary mb-0"><span class="text-dark-75 font-weight-bolder font-size-lg mb-0">Centro:</span> {{ $custodio->centro->nombre_centro }} - {{ $custodio->centro->nombre_sector_electoral }} - Área {{ $custodio->centro->codigo_area }}</p>
                                                            <p class="text-muted font-weight-bold text-hover-primary mb-0"><span class="text-dark-75 font-weight-bolder font-size-lg mb-0">Municipio:</span> {{ $custodio->municipio->nombre_municipio }}</p>
                                                            @endif
                                                            <p class="text-muted font-weight-bold text-hover-primary mb-0"><span class="text-dark-75 font-weight-bolder font-size-lg mb-0">Departamento:</span> {{ !empty($custodio->departamento->nombre_departamento) ? $custodio->departamento->nombre_departamento : '-' }}</p>
                                                            <p class="text-muted font-weight-bold text-hover-primary mb-0"><span class="text-dark-75 font-weight-bolder font-size-lg mb-0">Partido:</span> {{ $custodio->partido->nombre_partido }}</p>
                                                            <p class="text-muted font-weight-bold text-hover-primary mb-0"><span class="text-dark-75 font-weight-bolder font-size-lg mb-0">Tipo de Custodio:</span> {{ $custodio->tipoCustodio->tipo_custodio }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="label label-inline @if($custodio->cod_estado == 1) label-light-success @else label-light-danger @endif font-weight-bold">
                                                        {{ $custodio->estado->nombre_estado }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.custodios.show', $custodio->idc_custodio) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2 mb-2" title="Show details">
                                                        <i class="la la-file-pdf-o"></i> Ver Hoja
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">
                                                <div class="alert alert-custom alert-notice alert-light-primary fade show" role="alert">
                                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                                    <div class="alert-text">No hay registros!</div>
                                                    <div class="alert-close">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>{{ $custodios->links('pagination.default') }}</div>
                            <div>
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">Mostrar:</label>
                                    <select class="form-control  kt-selectpicker" id="cbo-mostrar">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <label class="ml-3 mb-0 d-none d-md-block">Total: {{ $total }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end: Datatable-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Busquedas
                const $inputDni = document.querySelector('#input-dni');
                const $cboPartido = document.querySelector('#cbo-partido');
                const $cboEstado = document.querySelector('#cbo-estado');
                const $cboMostrar = document.querySelector('#cbo-mostrar');
                const $url = document.querySelector('#url').value;
                let keycode = '';
                let dni = '';
                let estado = '';
                let partido = '';

                $inputDni.addEventListener('keypress', function(e) {
                    keycode = (e.keyCode ? e.keyCode : e.which);
                    dni = $inputDni.value;
                    estado = $cboEstado.value;
                    partido = $cboPartido.value;
                    mostrar = $cboMostrar.value;

                    validarFiltros(keycode, dni, partido, estado, mostrar);
                });

                $cboPartido.addEventListener('change', function(e) {
                    dni = $inputDni.value;
                    estado = $cboEstado.value;
                    partido = $cboPartido.value;
                    mostrar = $cboMostrar.value;

                    validarFiltrosSelects(dni, partido, estado, mostrar);
                });

                $cboEstado.addEventListener('change', function(e) {
                    dni = $inputDni.value;
                    estado = $cboEstado.value;
                    partido = $cboPartido.value;
                    mostrar = $cboMostrar.value;

                    validarFiltrosSelects(dni, partido, estado, mostrar);
                });

                $cboMostrar.addEventListener('change', function(e) {
                    dni = $inputDni.value;
                    estado = $cboEstado.value;
                    partido = $cboPartido.value;
                    mostrar = $cboMostrar.value;

                    validarFiltrosSelects(dni, partido, estado, mostrar);
                });

                const validarFiltros = (keycode, dni, partido, estado, mostrar) => {
                    if(keycode === 13 && dni !== '' && partido === '' && estado === '') {
                        location.href = `${$url}?dni_custodio=${dni}&mostrar=${mostrar}`;
                        return;
                    }

                    if(keycode === 13 && dni === '' && partido !== '' && estado === '') {
                        location.href = `${$url}?cod_partido=${partido}&mostrar=${mostrar}`;
                        return;
                    }

                    if(keycode === 13 && dni === '' && partido === '' && estado !== '') {
                        location.href = `${$url}?cod_estado=${estado}&mostrar=${mostrar}`;
                        return;
                    }

                    if(keycode === 13 && dni !== '' && partido !== '' && estado === '') {
                        location.href = `${$url}?dni_custodio=${dni}&cod_partido=${partido}&mostrar=${mostrar}`;
                        return;
                    }

                    if(keycode === 13 && dni !== '' && partido === '' && estado !== '') {
                        location.href = `${$url}?dni_custodio=${dni}&cod_estado=${estado}&mostrar=${mostrar}`;
                        return;
                    }

                    if(keycode === 13 && dni === '' && partido !== '' && estado !== '') {
                        location.href = `${$url}?cod_partido=${partido}&cod_estado=${estado}&mostrar=${mostrar}`;
                        return;
                    }

                    if(keycode === 13 && dni !== '' && partido !== '' && estado !== '') {
                        location.href = `${$url}?dni_custodio=${dni}&cod_partido=${partido}&cod_estado=${estado}&mostrar=${mostrar}`;
                        return;
                    }

                    if(keycode === 13 && dni === '' && partido === '' && estado === '') {
                        location.href = `${$url}?mostrar=${mostrar}`;
                        return;
                    }
                }

                const validarFiltrosSelects = (dni, partido, estado, mostrar) => {
                    if(dni !== '' && partido === '' && estado === '') {
                        location.href = `${$url}?dni_custodio=${dni}&mostrar=${mostrar}`;
                        return;
                    }

                    if(dni === '' && partido !== '' && estado === '') {
                        location.href = `${$url}?cod_partido=${partido}&mostrar=${mostrar}`;
                        return;
                    }

                    if(dni === '' && partido === '' && estado !== '') {
                        location.href = `${$url}?cod_estado=${estado}&mostrar=${mostrar}`;
                        return;
                    }

                    if(dni !== '' && partido !== '' && estado === '') {
                        location.href = `${$url}?dni_custodio=${dni}&cod_partido=${partido}&mostrar=${mostrar}`;
                        return;
                    }

                    if(dni !== '' && partido === '' && estado !== '') {
                        location.href = `${$url}?dni_custodio=${dni}&cod_estado=${estado}&mostrar=${mostrar}`;
                        return;
                    }

                    if(dni === '' && partido !== '' && estado !== '') {
                        location.href = `${$url}?cod_partido=${partido}&cod_estado=${estado}&mostrar=${mostrar}`;
                        return;
                    }

                    if(dni !== '' && partido !== '' && estado !== '') {
                        location.href = `${$url}?dni_custodio=${dni}&cod_partido=${partido}&cod_estado=${estado}&mostrar=${mostrar}`;
                        return;
                    }

                    if(dni === '' && partido === '' && estado === '') {
                        location.href = `${$url}?mostrar=${mostrar}`;
                        return;
                    }
                }
            });
        </script>
    @endpush
    @push('styles')
    <style>
        .pagination li {
            margin-left: .25rem;
            margin-right: .25rem;
        }

        .pagination li .page-link {
            border-radius: .25rem;
            border: none;
            min-width: 2.25rem;
            text-align: center;
            color: #4f5464;
        }

        .pagination li.active .page-link,
        .pagination li .page-link:hover {
            background-color: #1d97c9;
            color: #fff;
            font-weight: bold;
        }
    </style>
    @endpush
</x-app-layout>
