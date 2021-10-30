<x-app-layout>
    <x-slot name="header">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"> Bitácora de Custodios </h5>
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
                            Bitácora de Custodios
                            <span class="d-block text-muted pt-2 font-size-sm">Módulo para el control y seguimiento de estado de custodios</span>
                        </h3>
                    </div>
                    
                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ route('admin.bitacora-custodios.index') }}" class="btn btn-secondary font-weight-bolder mr-2">Limpiar filtros</a>
                        @if(count($bitacoras) > 0)
                            <div class="dropdown dropdown-inline mr-2">
                                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="svg-icon svg-icon-md">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                            height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none"
                                                fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path
                                                    d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                                    fill="#000000" opacity="0.3" />
                                                <path
                                                    d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                                    fill="#000000" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span> Exportar
                                </button>
        
                                <!--begin::Dropdown Menu-->
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <!--begin::Navigation-->
                                    <ul class="navi flex-column navi-hover py-2">
                                        <li
                                            class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                            Seleccione:
                                        </li>                          
                                        <li class="navi-item">
                                            <a href="{{ route('admin.bitacora-custodios.excel') }}?dni_custodio={{ $dni }}&fecha_desde={{ $desde }}&fecha_hasta={{ $hasta }}" id="btn-excel" class="navi-link">
                                                <span class="navi-icon"><i
                                                        class="la la-file-excel-o"></i></span>
                                                <span class="navi-text">Excel</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!--end::Navigation-->
                                </div>
                                <!--end::Dropdown Menu-->
                            </div>
                        @endif
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
                                <input type="text" class="form-control" placeholder="Search DNI Custodio Afectado..." id="input-dni" value="{{ request()->has('dni_custodio') ? request('dni_custodio') : ''   }}">
                                <span><i class="flaticon2-search-1 text-muted"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <label class="mr-3 mb-0 d-none d-md-block">Fecha desde:</label>
                                <input type="date" class="form-control" id="date-desde" name="fecha_desde" value="{{ $desde }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <label class="mr-3 mb-0 d-none d-md-block">Fecha Hasta:</label>
                                <input type="date" class="form-control" id="date-hasta" name="fecha_hasta" value="{{ $hasta }}">
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="datatable-bordered datatable-head-custom" id="table_custodios">
                        <div class="table-responsive">
                            <input type="hidden" id="url" value="{{ route('admin.bitacora-custodios.index') }}" />
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>FECHA HORA BITACORA</th>
                                        <th>DNI USUARIO ACCIÓN</th>
                                        <th>DNI CUSTODIO AFECTADO</th>
                                        <th>ACCIÓN EJECUTADA</th>
                                        <th class="text-center">DECRIPCIÓN</th>
                                        <th class="text-center">ACCIÓN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($bitacoras) > 0)
                                        @foreach($bitacoras as $bitacora)
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bolder">{{ $bitacora->fecha_hora_bitacora }}</span>
                                                </td>
                                                <td>
                                                    <span class="font-weight-bolder">{{ $bitacora->dni_usuario_accion }}</span>
                                                </td>
                                                <td>
                                                    <span class="font-weight-bolder">{{ $bitacora->dni_custodio }}</span>
                                                </td>
                                                <td>
                                                    @if($bitacora->accion == 'REGISTRO')
                                                        <span class="label label-inline label-light-success font-weight-bold">
                                                            {{ $bitacora->accion }}
                                                        </span>
                                                    @endif

                                                    @if($bitacora->accion == 'EDICION')
                                                        <span class="label label-inline label-light-primary font-weight-bold">
                                                            {{ $bitacora->accion }}
                                                        </span>
                                                    @endif

                                                    @if($bitacora->accion == 'ELIMINACION')
                                                        <span class="label label-inline label-light-danger font-weight-bold">
                                                            {{ $bitacora->accion }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="text-muted font-weight-bold text-hover-primary mb-0">{{ $bitacora->descripcion }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown dropdown-inline">
                                                        <a href="javascript:;" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2 mb-2" data-toggle="dropdown">
                                                            <span class="svg-icon svg-icon-md">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-icon">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24"/>
                                                                        <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"/>
                                                                        <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"/>
                                                                    </g>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                            <ul class="navi flex-column navi-hover py-2">
                                                                <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">
                                                                    Elije una opción:
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="{{ route('admin.bitacora-custodios.pdf', $bitacora->id_bitacora) }}" target="_blank" class="navi-link">
                                                                        <span class="navi-icon"><i class="la la-file-pdf-o"></i></span>
                                                                        <span class="navi-text">PDF</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('admin.custodios.edit', $bitacora->id_bitacora) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2 mb-2" title="Edit details">
                                                        <span class="svg-icon svg-icon-md">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "/>
                                                                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                </g>
                                                            </svg>
                                                        </span>
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
                            <div>{{ $bitacoras->links('pagination.default') }}</div>
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
                const $inputDateDesde = document.querySelector('#date-desde');
                const $inputDateHasta = document.querySelector('#date-hasta');
                const $cboMostrar = document.querySelector('#cbo-mostrar');
                const $url = document.querySelector('#url').value;
                let keycode = '';
                let dni = '';
                let hasta = '';
                let desde = '';

                $inputDni.addEventListener('keypress', function(e) {
                    keycode = (e.keyCode ? e.keyCode : e.which);
                    dni = $inputDni.value;
                    desde = $inputDateDesde.value;
                    hasta = $inputDateHasta.value;
                    mostrar = $cboMostrar.value;
                    
                    validarFiltros(keycode, dni, desde, hasta, mostrar);
                });

                $inputDateDesde.addEventListener('change', function(e) {
                    dni = $inputDni.value;
                    desde = $inputDateDesde.value;
                    hasta = $inputDateHasta.value;
                    mostrar = $cboMostrar.value;
                    
                    validarFiltrosInputDate(dni, desde, hasta, mostrar);
                });

                $inputDateHasta.addEventListener('change', function(e) {
                    dni = $inputDni.value;
                    desde = $inputDateDesde.value;
                    hasta = $inputDateHasta.value;
                    mostrar = $cboMostrar.value;
                    
                    validarFiltrosInputDate(dni, desde, hasta, mostrar);
                });
                    
                $cboMostrar.addEventListener('change', function(e) {
                    dni = $inputDni.value;
                    desde = $inputDateDesde.value;
                    hasta = $inputDateHasta.value;
                    mostrar = $cboMostrar.value;

                    validarFiltrosInputDate(dni, desde, hasta, mostrar);
                });

                const validarFiltros = (keycode, dni, desde, hasta, mostrar) => {
                    if(keycode === 13 && dni !== '' && desde === '' && hasta === '') {
                        location.href = `${$url}?dni_custodio=${dni}&mostrar=${mostrar}`;
                        return;
                    }

                    if(keycode === 13 && dni === '' && desde !== '' && hasta === '') {
                        location.href = `${$url}?fecha_desde=${desde}&mostrar=${mostrar}`;
                        return;
                    }

                    if(keycode === 13 && dni === '' && desde === '' && hasta !== '') {
                        location.href = `${$url}?fecha_hasta=${hasta}&mostrar=${mostrar}`;
                        return;
                    }

                    if(keycode === 13 && dni !== '' && desde !== '' && hasta === '') {
                        location.href = `${$url}?dni_custodio=${dni}&fecha_desde=${desde}&mostrar=${mostrar}`;
                        return;
                    }

                    if(keycode === 13 && dni !== '' && desde === '' && hasta !== '') {
                        location.href = `${$url}?dni_custodio=${dni}&fecha_hasta=${hasta}&mostrar=${mostrar}`;
                        return;
                    }

                    if(keycode === 13 && dni === '' && desde !== '' && hasta !== '') {
                        location.href = `${$url}?fecha_desde=${desde}&fecha_hasta=${hasta}&mostrar=${mostrar}`;
                        return;
                    }

                    if(keycode === 13 && dni !== '' && desde !== '' && hasta !== '') {
                        location.href = `${$url}?dni_custodio=${dni}&fecha_desde=${desde}&fecha_hasta=${hasta}&mostrar=${mostrar}`;
                        return;
                    }
                    
                    if(keycode === 13 && dni === '' && desde === '' && hasta === '') {
                        location.href = `${$url}?mostrar=${mostrar}`;
                        return;
                    }
                }

                const validarFiltrosInputDate = (dni, desde, hasta, mostrar) => {
                    if(dni !== '' && desde === '' && hasta === '') {
                        location.href = `${$url}?dni_custodio=${dni}&mostrar=${mostrar}`;
                        return;
                    }

                    if(dni === '' && desde !== '' && hasta === '') {
                        location.href = `${$url}?fecha_desde=${desde}&mostrar=${mostrar}`;
                        return;
                    }

                    if(dni === '' && desde === '' && hasta !== '') {
                        location.href = `${$url}?fecha_hasta=${hasta}&mostrar=${mostrar}`;
                        return;
                    }

                    if(dni !== '' && desde !== '' && hasta === '') {
                        location.href = `${$url}?dni_custodio=${dni}&fecha_desde=${desde}&mostrar=${mostrar}`;
                        return;
                    }

                    if(dni !== '' && desde === '' && hasta !== '') {
                        location.href = `${$url}?dni_custodio=${dni}&fecha_hasta=${hasta}&mostrar=${mostrar}`;
                        return;
                    }

                    if(dni === '' && desde !== '' && hasta !== '') {
                        location.href = `${$url}?fecha_desde=${desde}&fecha_hasta=${hasta}&mostrar=${mostrar}`;
                        return;
                    }

                    if(dni !== '' && desde !== '' && hasta !== '') {
                        location.href = `${$url}?dni_custodio=${dni}&fecha_desde=${desde}&fecha_hasta=${hasta}&mostrar=${mostrar}`;
                        return;
                    }
                    
                    if(dni === '' && desde === '' && hasta === '') {
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
