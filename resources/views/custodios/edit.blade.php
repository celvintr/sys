<x-app-layout>
    <x-slot name="header">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"> Editar Custodio </h5>
    </x-slot>

    <div class="row">
        <div class="col">
            <form method="POST" action="{{ route('admin.custodios.update', $custodio->idc_custodio) }}" class="form form-custodio" id="form" enctype="multipart/form-data" data-return="{{ route('admin.custodios.index') }}">
                {{ csrf_field() }}
                
                <div class="card card-custom">
                    <div class="alert alert-danger alert-errores d-none" role="alert"></div>
                    <div class="card-header card-header-tabs-line">
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
                                        <span class="nav-icon"><i class="far fa-file-alt"></i></span>
                                        <span class="nav-text">Datos Generales</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_4">
                                        <span class="nav-icon"><i class="fas fa-map-marker-alt"></i></span>
                                        <span class="nav-text">Dirección</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3_4">
                                        <span class="nav-icon"><i class="fas fa-image"></i></span>
                                        <span class="nav-text">Fotos</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>DNI:</label>
                                                <input type="text" name="dni_custodio" class="form-control form-control-solid" value="{{ $custodio->dni_custodio }}" readonly />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>COD CUSTODIO:</label>
                                                <input type="text" name="cod_custodio" class="form-control form-control-solid" value="{{ $custodio->cod_custodio }}" readonly />
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Nombre custodio:</label>
                                                <input type="text" name="nombre_custodio" class="form-control" value="{{ $custodio->nombre_custodio }}" required />
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Teléfono móvil</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-mobile-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" value="{{ $custodio->tel_movil }}" name="tel_movil" maxlength="25" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Teléfono fijo</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-phone-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" value="{{ $custodio->tel_fijo }}" name="tel_fijo" maxlength="25" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">{{ 'Correo #1' }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-envelope"></i>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" value="{{ $custodio->correo1_custodio }}" name="correo1_custodio" maxlength="50" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">{{ 'Correo #2' }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-envelope"></i>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" value="{{ $custodio->correo2_custodio }}" name="correo2_custodio" maxlength="50" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Estado:</label>
                                                <select name="cod_estado" id="cod_estado" class="form-control select-centros kt-selectpicker" data-size="7" data-live-search="true">
                                                    <option value="">::. Seleccione .::</option>
                                                    @foreach($estados as $estado)
                                                        <option value="{{ $estado->cod_estado }}" @if($estado->cod_estado == $custodio->cod_estado) selected @endif>{{ $estado->nombre_estado }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Partido Político:</label>
                                                <select name="cod_partido" id="cbo-partido" class="form-control kt-selectpicker"  @if(!is_null($user->cod_partido)) disabled @endif>
                                                    @if(!is_null($user->cod_partido))
                                                        @foreach ($partidos as $item)
                                                            @if($item->cod_partido == $user->cod_partido)
                                                                <option value="{{ $item->cod_partido }}" @if($item->cod_partido == $custodio->cod_partido) selected @endif>{{ $item->nombre_partido }}</option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <option value="">::. Seleccione .::</option>
                                                        @foreach ($partidos as $item)
                                                            <option value="{{ $item->cod_partido }}" @if($item->cod_partido == $custodio->cod_partido) selected @endif>{{ $item->nombre_partido }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Tipo de Custodio:</label>
                                                    <input type="text" name="cod_tipo_custodio" id="cod_tipo_custodio" class="form-control form-control-solid" value="{{ $custodio->tipoCustodio->tipo_custodio }}" readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Departamentos:</label>
                                                <select name="cod_departamento" id="cod_departamento" class="form-control cbo-departamentos kt-selectpicker" data-id="{{ $custodio->cod_departamento }}" data-child="#cod_municipio" data-size="7" data-live-search="true">
                                                    <option value="">::. Seleccione .::</option>
                                                    @foreach ($departamentos as $item)
                                                        <option value="{{ $item->cod_departamento }}" @if($item->cod_departamento == $custodio->cod_departamento) selected @endif>{{ $item->nombre_departamento }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group" id="contenedor-centros" @if($custodio->cod_tipo_custodio == 2) style="display: none;" @endif>
                                                <label>Municipios:</label>
                                                <select name="cod_municipio" id="cod_municipio" class="form-control select-municipios kt-selectpicker" data-child="#cod_centro" data-size="7" data-live-search="true">
                                                    <option value="">::. Seleccione .::</option>
                                                    @foreach($municipios as $municipio)
                                                        <option value="{{ $municipio->cod_municipio }}" @if($municipio->cod_municipio == $custodio->cod_municipio) selected @endif>{{ $municipio->nombre_municipio }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group" id="contenedor-centros" @if($custodio->cod_tipo_custodio == 2) style="display: none;" @endif>
                                                <label>Centro de Votación:</label>
                                                <select name="cod_centro" id="cod_centro" class="form-control cbo-centros kt-selectpicker" data-size="7" data-live-search="true">
                                                    <option value="">::. Seleccione .::</option>
                                                    @foreach($centros as $centro)
                                                        <option value="{{ $centro->cod_centro }}" @if($centro->cod_centro == $custodio->cod_centro) selected @endif>{{ $centro->nombre_centro }} - {{ $centro->nombre_sector_electoral }} - Área {{ $centro->codigo_area }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Dirección</label>
                                                <textarea name="dir_custodio" class="form-control" rows="10">{{ $custodio->dir_custodio }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="kt_tab_pane_3_4" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
                                <div class="card-body">
                                    <div class="form-row mb-5">
                                        <div class="col-lg-4">
                                            <label class="d-block mb-3 text-center">Foto:</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="image-input image-input-outline" id="kt_foto_custodio">
                                                    <div class="image-input-wrapper" style="background-image: url({{ $custodio->foto }})"></div>

                                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="change"
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="Cambia foto">
                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                        <input type="file" name="foto_custodio" accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="foto_custodio_remove" />
                                                    </label>

                                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="cancel"
                                                        data-toggle="tooltip"
                                                        title="Cancelar foto">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label class="d-block mb-3 text-center">Foto DNI:</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="image-input image-input-outline" id="kt_foto_dni_custodio">
                                                    <div class="image-input-wrapper" style="background-image: url({{ $custodio->foto_dni }}"></div>

                                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="change"
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="Cambia foto DNI">
                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                        <input type="file" name="foto_dni_custodio" accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="foto_dni_custodio_remove" />
                                                    </label>

                                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="cancel"
                                                        data-toggle="tooltip"
                                                        title="Cancelar foto DNI">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label class="d-block mb-3 text-center">Foto Comp.:</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="image-input image-input-outline" id="kt_foto_comp_custodio">
                                                    <div class="image-input-wrapper" style="background-image: url({{ $custodio->foto_comp }})"></div>

                                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="change"
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="Cambia foto comp">
                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                        <input type="file" name="foto_comp_custodio" accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="foto_comp_custodio_remove" />
                                                    </label>

                                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                        data-action="cancel"
                                                        data-toggle="tooltip"
                                                        title="Cancelar foto DNI">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-primary mx-1" id="btn-guardar">
                            <i class="far fa-save"></i> Guadar
                        </button>
                        <a href="{{ route('admin.custodios.index') }}" class="btn btn-secondary mx-1">
                            <i class="fas fa-ban"></i> Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.kt-selectpicker').selectpicker();

                if ($('.cbo-departamentos').length && $('.select-municipios').length) {
                    $('.cbo-departamentos').on('change', function(e) {
                        var $departamento = $(this);
                        var $municipio = $($departamento.data('child'));
                        const tipoCustodio = document.querySelector('#cbo-tipo-custodio').value;

                        $municipio.html(`<option>::. Seleccione .::</option>`);
                        $municipio.selectpicker('refresh');

                        if ($departamento.val() && parseInt(tipoCustodio) === 1) {
                            axios.get('{{ url('/api/municipios') }}/' + $departamento.val())
                            .then(function (response) {
                                var data = response.data;
                                var output = ``;
                                data.forEach(item => {
                                    output += `<option value="${item.cod_municipio}">${item.nombre_municipio}</option>`;
                                });
                                $municipio.html(output);
                                $municipio.selectpicker('refresh');
                                $municipio.trigger('change');
                            })
                            .catch(function (error) {
                                // handle error
                                console.log(error);
                            });
                        }
                    });
                }

                if ($('.select-municipios').length && $('.cbo-centros').length) {
                    $('.select-municipios').on('change', function(e) {
                        const $municipio = $(this);
                        const $centro = $($municipio.data('child'));
                        const $partido = document.querySelector('#cbo-partido').value;
                        const tipoCustodio = document.querySelector('#cod_tipo_custodio').value;

                        if ($municipio.val() && parseInt(tipoCustodio) !== 2) {
                            axios.get('{{ url('/admin/custodios/centros') }}/' + $municipio.val() + '/' + $partido) 
                            .then(function (response) {
                                let data = response.data;
                                let output = `<option>::. Seleccione un centro .::</option>`;

                                if(data.length > 0) {
                                    data.forEach(item => {
                                        output += `<option value="${item.cod_centro}">${item.nombre_centro} - ${item.nombre_sector_electoral} - Área ${item.codigo_area}</option>`;
                                    });
                                } else {
                                    output = '<option>::. No hay centros disponibles para este partido .::</option>';
                                }

                                $centro.html(output);
                                $centro.selectpicker('refresh');
                            })
                            .catch(function (error) {
                                // handle error
                                console.log(error);
                            });
                        }
                    });
                }

                document.querySelector('#cbo-partido').addEventListener('change', function() {
                    const $centros = document.querySelector('#cod_centro');

                    if($centros.value) {
                        const $municipio = $('#cod_municipio');
                        const $centro = $($municipio.data('child'));
                        const $partido = document.querySelector('#cbo-partido').value;

                        $centro.html(`<option value="">::. Seleccione un centro .::</option>`);
                        $centro.selectpicker('refresh');

                        if($partido !== '') {
                            axios.get('{{ url('/admin/custodios/centros') }}/' + $municipio.val() + '/' + $partido) 
                                .then(function (response) {
                                    let data = response.data;
                                    let output = `<option value="">::. Seleccione un centro .::</option>`;
                                    console.log(data)
                                    data.forEach(item => {
                                        output += `<option value="${item.cod_centro}">${item.nombre_centro} - ${item.nombre_sector_electoral} - Área ${item.codigo_area}</option>`;
                                    });
                                    $centro.html(output);
                                    $centro.selectpicker('refresh');
                                })
                                .catch(function (error) {
                                    // handle error
                                    console.log(error);
                                });
                        } else {
                            let output = `<option value="">::. Seleccione un centro .::</option>`;
                            $centro.html(output);
                            $centro.selectpicker('refresh');
                        }
                    }
                });

                // Formulario
                const foto_custodio = new KTImageInput('kt_foto_custodio');
                const foto_dni_custodio = new KTImageInput('kt_foto_dni_custodio');
                const foto_comp_custodio = new KTImageInput('kt_foto_comp_custodio');

                $('.form-custodio').on('submit', function(e) {
                    e.preventDefault();

                    const btnGuardar = document.querySelector('#btn-guardar');
                    btnGuardar.disabled = true;

                    const $form = document.getElementById('form');
                    const formData = new FormData($form);
                    formData.append('cod_partido', document.querySelector('#cbo-partido').value);
                    
                    axios.post($form.action, formData)
                    .then(function (response) {
                        btnGuardar.disabled = false;
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
                        btnGuardar.disabled = false;
                        Swal.fire({
                            title: 'Error!',
                            text: 'Ha ocurrido un error al tratar de editar el registro, por favor intenta de nuevo.',
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
            });
        </script>
    @endpush

    @push('styles')
    @endpush
</x-app-layout>
