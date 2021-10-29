<x-app-layout>
    <x-slot name="header">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"> Agregar Custodio </h5>
    </x-slot>

    <div class="row">
        <div class="col">
            @if(empty($form))
                <div class="card card-custom my-5">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.custodios.dni') }}">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group m-0">
                                        <label>DNI del postulante a custodio:</label>
                                        <div class="input-group input-group-lg">
                                            <input name="dni" required type="text" @if(session()->has('dni_numero')) value="{{ session('dni_numero') }}" @endif class="form-control text-bold" maxlength="13" placeholder="Ingrese el DNI..."/>
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary" type="submit" id="btn-dni">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @if (session()->has('dni_error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('dni_error') }}
                    </div>
                @endif
            @else
                <form method="POST" action="{{ route('admin.custodios.store') }}" class="form form-custodio" id="form" enctype="multipart/form-data" data-return="{{ route('admin.custodios.index') }}">
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
                                                    <input type="text" name="dni_custodio" class="form-control form-control-solid" value="{{ $form->dni_custodio }}" readonly />
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Nombre custodio:</label>
                                                    <input type="text" name="nombre_custodio" class="form-control" value="{{ $form->nombre_custodio }}" required />
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
                                                        <input type="text" class="form-control" name="tel_movil" maxlength="25" />
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
                                                        <input type="text" class="form-control" name="tel_fijo" maxlength="25" />
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
                                                        <input type="email" class="form-control" name="correo1_custodio" maxlength="50" />
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
                                                        <input type="email" class="form-control" name="correo2_custodio" maxlength="50" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Partido Político:</label>
                                                    <select name="cod_partido" id="cbo-partido" class="form-control kt-selectpicker">
                                                        <option value="">::. Seleccione .::</option>
                                                        @foreach ($partidos as $item)
                                                            <option value="{{ $item->cod_partido }}">{{ $item->nombre_partido }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Tipo de Custodio:</label>
                                                    <select name="cod_tipo_custodio" id="cbo-tipo-custodio" class="form-control kt-selectpicker">
                                                        <option value="">::. Seleccione .::</option>
                                                        @foreach ($tiposCustodio as $tipo)
                                                            <option value="{{ $tipo->cod_tipo_custodio }}">{{ $tipo->tipo_custodio }}</option>
                                                        @endforeach
                                                    </select>
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
                                                    <select name="cod_departamento" id="cod_departamento" class="form-control cbo-departamentos kt-selectpicker" data-child="#cod_municipio" data-size="7" data-live-search="true">
                                                        <option value="">::. Seleccione .::</option>
                                                        @foreach ($departamentos as $item)
                                                            <option value="{{ $item->cod_departamento }}">{{ $item->nombre_departamento }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group" id="contenedor-municipios">
                                                    <label>Municipios:</label>
                                                    <select name="cod_municipio" id="cod_municipio" class="form-control select-municipios kt-selectpicker" data-child="#cod_centro" data-size="7" data-live-search="true">
                                                        <option value="">::. Seleccione .::</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group" id="contenedor-centros">
                                                    <label>Centro de Votación:</label>
                                                    <select name="cod_centro" id="cod_centro" class="form-control cbo-centros kt-selectpicker" data-size="7" data-live-search="true">
                                                        <option value="">::. Seleccione .::</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Dirección</label>
                                                    <textarea name="dir_custodio" class="form-control" rows="10"></textarea>
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
                                                        <div class="image-input-wrapper" style="background-image: url(https://ui-avatars.com/api/?name={{ $form->nombre_custodio }}&color=7F9CF5&background=EBF4FF)"></div>

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
                                                        <div class="image-input-wrapper" style="background-image: url(https://ui-avatars.com/api/?name={{ $form->nombre_custodio }}&color=7F9CF5&background=EBF4FF)"></div>

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
                                                        <div class="image-input-wrapper" style="background-image: url(https://ui-avatars.com/api/?name={{ $form->nombre_custodio }}&color=7F9CF5&background=EBF4FF)"></div>

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
            @endif

        </div>
    </div>

    @push('scripts')
        @if(!empty($form))
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
                        } else {

                        }
                    });
                }

                if ($('.select-municipios').length && $('.cbo-centros').length) {
                    $('.select-municipios').on('change', function(e) {
                        const $municipio = $(this);
                        const $centro = $($municipio.data('child'));
                        const $partido = document.querySelector('#cbo-partido').value;
                        const tipoCustodio = document.querySelector('#cbo-tipo-custodio').value;

                        if($partido === '' && parseInt(tipoCustodio) === 1) {
                            alert('Por favor selecciona un partido político');
                            return;
                        }

                        if ($municipio.val() && parseInt(tipoCustodio) !== 2) {
                            axios.get('{{ url('/admin/custodios/centros') }}/' + $municipio.val() + '/' + $partido) 
                            .then(function (response) {
                                let data = response.data;
                                let output = `<option>::. Seleccione un centro .::</option>`;

                                if(data.length > 0) {
                                    data.forEach(item => {
                                        output += `<option value="${item.cod_centro}">${item.nombre_centro} - ${item.nombre_sector_electoral}</option>`;
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

                        if($partido !== '') {
                            axios.get('{{ url('/admin/custodios/centros') }}/' + $municipio.val() + '/' + $partido) 
                                .then(function (response) {
                                    let data = response.data;
                                    let output = `<option value="">::. Seleccione un centro .::</option>`;

                                    data.forEach(item => {
                                        output += `<option value="${item.cod_centro}">${item.nombre_centro} - ${item.nombre_sector_electoral}</option>`;
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

                document.querySelector('#cbo-tipo-custodio').addEventListener('change', function() {
                    const $cboCentros = document.querySelector('#contenedor-centros');
                    const $cboMunicipios = document.querySelector('#contenedor-municipios');
                    const tipoCustodio = document.querySelector('#cbo-tipo-custodio').value;
                  
                    if(parseInt(tipoCustodio) === 2) {
                        $cboCentros.style.display = 'none';
                        $cboMunicipios.style.display = 'none';
                    } else {
                        $cboCentros.style.display = 'block';
                        $cboMunicipios.style.display = 'block';
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

                    const $form = $(this);
                    const formData = new FormData(document.getElementById($form.attr('id')));

                    axios.post($(this).attr('action'), formData)
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
                                    if ($form.data('return')) location.href = $form.data('return');
                                    else location.reload();
                                }
                            });
                        }
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        btnGuardar.disabled = false;
                        
                        Swal.fire({
                            title: 'Error!',
                            text: 'Ha ocurrido un error al tratar de crear el registro, por favor intenta de nuevo.',
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
        @endif
    @endpush

    @push('styles')
    @endpush
</x-app-layout>
