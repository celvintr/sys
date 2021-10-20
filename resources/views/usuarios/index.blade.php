<x-app-layout>
    <x-slot name="header">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Tablero  <span style="color:#a1a5b7!important;font-size:.95rem!important"> | Administración - Seguridad - Usuarios</span></h5>
    </x-slot>

    <div class="row">
        <div class="col">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">
                            Registro de Usuarios
                            <span class="d-block text-muted pt-2 font-size-sm">Módulo para el control y registro de Usuarios del sistema</span>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Dropdown-->
                        <div class="dropdown dropdown-inline mr-2">
                            <!--begin::Dropdown Menu-->

                            <!--end::Dropdown Menu-->
                        </div>
                        <!--end::Dropdown-->

                        <!--begin::Button-->
                        <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary font-weight-bolder">
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
                    <div class="wrapper-search mb-5">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group m-0">
                                    <label class="d-block">Buscar:</label>
                                    <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="Buscar..." id="filtro_buscar" />
                                        <span><i class="flaticon2-search-1 text-muted"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group m-0">
                                    <label class="d-block">Estado:</label>
                                    <select class="form-control" id="filtro_estado_usuario">
                                        <option value="">Todos</option>
                                        @foreach (config('cons.usuarios-estado') as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--begin: Datatable-->
                    <div class="datatable datatable-bordered datatable-head-custom" id="table_usuarios"></div>
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
                var datatable = $('#table_usuarios').KTDatatable({
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                method: 'GET',
                                url: '{{ route('admin.usuarios.data') }}',
                            }
                        },
                        pageSize: 10, // display 20 records per page
                        serverPaging: true,
                        serverFiltering: true,
                        serverSorting: true
                    },

                    // layout definition
                    layout: {
                        scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                        footer: false, // display/hide footer
                    },

                    // column sorting
                    sortable: true,

                    pagination: true,

                    search: {
                        input: $('#filtro_buscar'),
                        key: 'buscar'
                    },

                    // columns definition
                    columns: [
                     {
                            field: 'nombre_usuario',
                            title: 'Nombre',
                            width: 250,
                            template: function(data) {
                                var output = `<div class="d-flex font-weight-bold align-items-center">${data.nombre_usuario}</div>`;

                                return output;
                            }
                        }, {
                            field: 'dni_usuario',
                            title: 'DNI',
                            width: 120,
                            template: function(data) {
                                var output = `<div class="d-flex font-weight-bold align-items-center">${data.dni_usuario}</div>`;

                                return output;
                            }
                        }, {
                            field: 'cargo_usuario',
                            title: 'Cargo',
                            width:200,
                            template: function(data) {
                                var output = `<div class="d-flex font-weight-bold align-items-center">${data.cargo_usuario}</div>`;

                                return output;
                            }
                        }, {
                            field: 'correo_usuario',
                            title: 'Correo',
                            width:200,
                            template: function(data) {
                                var output = `<div class="d-flex font-weight-bold align-items-center">${data.correo_usuario}</div>`;

                                return output;
                            }
                        }, {
                            field: 'tel_usuario',
                            title: 'Teléfono',
                            width:200,
                            template: function(data) {
                                var output = `<div class="d-flex font-weight-bold align-items-center">${data.tel_usuario}</div>`;

                                return output;
                            }
                        },
                        {
                            field: 'estado_usuario',
                            title: 'Estado',
                            width:100,
                            template: function(data) {
                                var status = {
                                    1: {
                                        'title': 'Activo',
                                        'class': ' label-light-success'
                                    },
                                    2: {
                                        'title': 'Inactivo',
                                        'class': ' label-light-danger'
                                    },
                                };

                                return '<span class="label font-weight-bold label-lg ' + status[data.estado_usuario].class + ' label-inline">' + status[data.estado_usuario].title + '</span>';
                            }
                        },
                        {
                            field: 'Acciones',
                            title: 'Acciones',
                            sortable: false,
                            width: 130,
                            overflow: 'visible',
                            autoHide: false,
                            template: function(data) {
                                return `
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="navi flex-column navi-hover py-2">
                                            <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">
                                                Choose an action:
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon"><i class="la la-print"></i></span>
                                                    <span class="navi-text">Print</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon"><i class="la la-copy"></i></span>
                                                    <span class="navi-text">Copy</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon"><i class="la la-file-excel-o"></i></span>
                                                    <span class="navi-text">Excel</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon"><i class="la la-file-text-o"></i></span>
                                                    <span class="navi-text">CSV</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon"><i class="la la-file-pdf-o"></i></span>
                                                    <span class="navi-text">PDF</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="{{ url('admin/usuarios/editar') }}/${data.idc_usuario}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit details">
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
                                    <a href="javascript:;" data-url="{{ url('admin/usuarios/eliminar-usuario') }}/${data.idc_usuario}" class="delete-link btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" title="Delete">
                                        <span class="svg-icon svg-icon-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>
                                                    <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                                </g>
                                            </svg>
                                        </span>
                                    </a>
                                `;
                            },
                        }],
                });

                $(document).on('change', '#filtro_estado_usuario', function() {
                    datatable.search($(this).val().toLowerCase(), 'estado_usuario');
                });
            });
        </script>

        <script>
            jQuery(document).on('click', '.delete-link', function () {
                Swal.fire({
                    title: "Está seguro?",
                    text: "Esta acción es irreversible!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Si, Eliminar!",
                    cancelButtonText: "No, cancelar!",
                    confirmButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var link_id = $(this).val();
                        var dni_usuario = $(this).data('id');
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "DELETE",
                            url: $(this).data('url'),
                            success: function (data) {
                                Swal.fire({
                                    title: "Exito",
                                    text: data.message,
                                    icon: data.type,
                                    showCancelButton: false,
                                    confirmButtonText: "Aceptar",
                                    reverseButtons: true
                                }).then(function(result) {
                                    if (result.value) {
                                        location.reload();
                                    }
                                });
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
