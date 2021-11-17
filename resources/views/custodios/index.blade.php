<x-app-layout>
    <x-slot name="header">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"> Custodios </h5>
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
                            Registro de Custodios
                            <span class="d-block text-muted pt-2 font-size-sm">Módulo para el control y registro de custodios</span>
                        </h3>
                    </div>

                    <div class="card-toolbar">
                        <!--begin::Button-->
                        <a href="{{ route('admin.custodios.index') }}" class="btn btn-secondary font-weight-bolder mr-2">Limpiar filtros</a>
                        @if(count($custodios) > 0)
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
                                            <a href="{{ route('admin.custodios.excel') }}?dni_custodio={{ $dni }}&cod_partido={{ $partido }}&cod_estado={{ $estado }}" id="btn-excel" class="navi-link">
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
                        <a href="{{ route('admin.custodios.create') }}" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" cx="9" cy="15" r="6" />
                                        <path
                                            d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span> Nuevo Registro
                        </a>
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
                                    @else"
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
                                    @else"
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
                                                    @if($custodio->cod_estado == 1)
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
                                                                    <a href="{{ route('admin.custodios.pdf', $custodio->idc_custodio) }}" target="_blank" class="navi-link">
                                                                        <span class="navi-icon"><i class="la la-file-pdf-o"></i></span>
                                                                        <span class="navi-text">PDF</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <a href="{{ route('admin.custodios.show', $custodio->idc_custodio) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2 mb-2" title="Show details">
                                                        <span class="svg-icon svg-icon-md">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000"/>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <a href="{{ route('admin.custodios.edit', $custodio->idc_custodio) }}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2 mb-2" title="Edit details">
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
                                                    <button type="button" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mb-2" title="Delete" data-toggle="modal" data-target="#modal-eliminar-custodio" data-id="{{ $custodio->idc_custodio }}">
                                                        <span class="svg-icon svg-icon-md">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"/>
                                                                    <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>
                                                                    <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                    </button>
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
        <!-- Modal-->
        <div class="modal fade" id="modal-eliminar-custodio" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Custodio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro que quieres eliminar este registro?
                    </div>
                    <div class="modal-footer">
                        <form action="" class="formEliminar" method="POST" style="display: inline-block; float: right;" data-return="{{ route('admin.custodios.index') }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" id="idCustodio" value="" name="idCustodio">
                            <button type="submit" class="btn btn-danger font-weight-bold">Si, quiero eliminar.</button>
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // var datatable = $('#table_custodios').KTDatatable({});

                // Modal
                $('#modal-eliminar-custodio').on('show.bs.modal', function(e) {
                    $(this).find('#idCustodio').attr('value', $(e.relatedTarget).data('id'));
                    $('.debug-url').html('Delete URL: <strong>' + $(this).find('.formEliminar').attr('action') + '</strong>');
                });

                const $form = document.querySelector('.formEliminar');

                $form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const id = document.querySelector('#idCustodio').value;

                    $('#modal-eliminar-custodio').modal('hide');

                    axios.delete("{{ url('/admin/custodios/delete') }}/" + id)
                    .then(function (response) {
                        const data = response.data;

                        $('.alert-errores').addClass('d-none');
                        $('.alert-errores').html('');
                        if (data.errors) {
                            $.each(data.errors, function(key, value){
                                $('.alert-errores').removeClass('d-none');
                                $('.alert-errores').append(`<p>${value}</p>`);
                            });
                        } else {
                            Swal.fire({
                                title: data.error ? 'Error!' : 'Exito',
                                text: data.message,
                                icon: data.error ? 'info' : 'success',
                                showCancelButton: false,
                                confirmButtonText: "Aceptar",
                                reverseButtons: true
                            }).then(function(result) {
                                if (result.value) {
                                    if ($form.dataset.return) location.href = $form.dataset.return;
                                    else location.reload();
                                }
                            });
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Ha ocurrido un error al tratar de eliminar el custodio, por favor intenta de nuevo.',
                            icon: 'info',
                            showCancelButton: false,
                            confirmButtonText: "Aceptar",
                            reverseButtons: true
                        }).then(function(result) {
                            if (result.value) {
                                if ($form.dataset.return) location.href = $form.dataset.return;
                                else location.reload();
                            }
                        });
                    });
                });

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
