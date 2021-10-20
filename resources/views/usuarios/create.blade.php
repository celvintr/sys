<x-app-layout>
    <x-slot name="header">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"> Agregar Custodio </h5>
    </x-slot>

    <div class="row">
        <div class="col">

              
                <form method="POST" action="{{ route('admin.usuarios.store') }}" class="form form-ajax" id="form" enctype="multipart/form-data" data-return="{{ route('admin.usuarios.index') }}">
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
                                                    <label for="">DNI</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-credit-card"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" name="dni_usuario" class="form-control" value=" " required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Nombre del usuario:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" name="nombre_usuario" class="form-control" value=" " required />
                                                    </div>
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
                                                        <input type="text" class="form-control" name="tel_usuario" maxlength="25" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Teléfono fio</label>
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
                                                    <label for="">{{ 'Correo' }}</label>
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
                                                    <label for="">{{ 'Contraseña' }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-key"></i>
                                                            </span>
                                                        </div>
                                                        <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Contraseña" name="pass_usuario" autocomplete="current-password" />
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
                                                    <select name="cod_departamento" id="cod_departamento" class="form-control select-departamentos kt-selectpicker" data-child="#cod_municipio" data-size="7" data-live-search="true">
                                                        <option value="">::. Seleccione .::</option>
                                                        @foreach ($departamentos as $item)
                                                            <option value="{{ $item->cod_departamento }}">{{ $item->nombre_departamento }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Municipios:</label>
                                                    <select name="cod_municipio" id="cod_municipio" class="form-control select-municipios kt-selectpicker" data-child="#cod_centro" data-size="7" data-live-search="true">
                                                        <option value="">::. Seleccione .::</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Centro de Votación:</label>
                                                    <select name="cod_centro" id="cod_centro" class="form-control select-centros kt-selectpicker" data-size="7" data-live-search="true">
                                                        <option value="">::. Seleccione .::</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Partido Político:</label>
                                                    <select name="cod_partido" class="form-control kt-selectpicker">
                                                    
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

                                 
                            </div>
                        </div>

                        <div class="card-footer d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-primary mx-1">
                                <i class="far fa-save"></i> Guadar
                            </button>
                            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary mx-1">
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
               // var foto_custodio = new KTImageInput('kt_foto_custodio');
            //    var foto_dni_custodio = new KTImageInput('kt_foto_dni_custodio');
              //  var foto_comp_custodio = new KTImageInput('kt_foto_comp_custodio');

                $('.form-ajax').on('submit', function(e) {
                    e.preventDefault();

                    var $form = $(this);
                    var formData = new FormData(document.getElementById($form.attr('id')));

                    axios.post($(this).attr('action'), formData)
                    .then(function (response) {
                        console.log(response);
                        var data = response.data;

                        $('.alert-errores').addClass('d-none');
                        $('.alert-errores').html('');
                        if (data.errors) {
                            $.each(data.errors, function(key, value){
                                $('.alert-errores').removeClass('d-none');
                                $('.alert-errores').append(`<p>${value}</p>`);
                            });
                        } else {
                            Swal.fire({
                                title: "Exito",
                                text: data.success,
                                icon: "success",
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
                    });


                });
            });
        </script>
    @endpush

    @push('styles')
    @endpush
</x-app-layout>
