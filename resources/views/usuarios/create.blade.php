<x-app-layout>
    <x-slot name="header">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"> {{ $title }} </h5>
    </x-slot>

    <div class="row">
        <div class="col">
            <form method="POST" action="{{ $action }}" class="form form-ajax" id="form" enctype="multipart/form-data" data-return="{{ route('admin.usuarios.index') }}">
                @method($method)

                <div class="card card-custom">

                    <div class="alert alert-danger alert-errores d-none mb-1" role="alert"></div>

                    <div class="card-header card-header-tabs-line">
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-bold nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
                                        <span class="nav-icon"><i class="far fa-file-alt"></i></span>
                                        <span class="nav-text">Datos Generales</span>
                                    </a>
                                </li>
                                <li id="tab-direccion" class="nav-item {{ $method == 'POST' ? 'd-none' : '' }}">
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
                                                    <input type="text" name="dni_usuario" id="dni_usuario" class="form-control" value="{{ $form->dni_usuario }}" maxlength="13" {{ $method == 'PUT' ? 'disabled' : '' }} autofocus />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Perfil de usuario:</label>
                                                <select name="cod_rol" id="cod_rol" class="form-control kt-selectpicker">
                                                    @if ($form->cod_rol)
                                                        <option value="">::. Seleccione .::</option>
                                                    @endif
                                                    @foreach ($roles as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == $form->cod_rol ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                                                    <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" value="{{ $form->nombre_usuario }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Cargo</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-user-md"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="cargo_usuario" id="cargo_usuario" value="{{ $form->cargo_usuario }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Teléfono</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-mobile-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" id="tel_usuario" name="tel_usuario" value="{{ $form->tel_usuario }}" maxlength="8" />
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
                                                    <input type="email" class="form-control" id="correo_usuario" name="correo_usuario" value="{{ $form->correo_usuario }}" maxlength="50" {{ $method == 'PUT' ? 'disabled' : '' }} />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 {{ $form->cod_rol == 2 ? '' : 'd-none' }}" id="wrapper-partidos">
                                            <div class="form-group">
                                                <label>Partido:</label>
                                                <select name="cod_partido" id="cod_partido" class="form-control kt-selectpicker">
                                                    <option value="">::. Seleccione .::</option>
                                                    @foreach ($partidos as $item)
                                                        <option value="{{ $item->cod_partido }}" {{ $item->cod_partido == $form->cod_partido ? 'selected' : '' }}>
                                                            {{ $item->nombre_partido }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($method == 'PUT')
                                        <div class="form-row" id="wrapper-update-pass">
                                            <div class="col">
                                                <input type="hidden" name="update_pass" value="">
                                                <button type="button" id="btn-update-pass" class="btn btn-light">
                                                    <i class="fas fa-key"></i> Cambiar contraseña
                                                </button>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="form-row {{ $method == 'PUT' ? 'd-none' : 'd-flex' }}" id="wrapper-pass">
                                        <div class="col-lg-6">
                                            <div class="d-flex align-items-center">
                                                <div class="form-group w-100 mr-1">
                                                    <label for="">{{ 'Contraseña' }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-key"></i>
                                                            </span>
                                                        </div>
                                                        <input class="form-control" type="password" placeholder="Contraseña" name="pass_usuario" id="pass_usuario" autocomplete="current-password" />
                                                    </div>
                                                </div>
                                                <div class="form-group" style="min-width: 175px;">
                                                    <label class="d-block">&nbsp;</label>
                                                    <button type="button" class="btn btn-light" id="btn-generate-pass">
                                                        <i class="fas fa-lock"></i> Generar Password
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">{{ 'Confirmar Contraseña' }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-key"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control" type="password" placeholder="Contraseña" name="pass_usuario_confirmation" id="pass_usuario_confirmation" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <span id="password-generated"></span>
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
                                                    @if ($form->cod_departamento)
                                                        <option value="">::. Seleccione .::</option>
                                                    @endif
                                                    @foreach ($departamentos as $item)
                                                        <option value="{{ $item->cod_departamento }}" {{ $item->cod_departamento == $form->cod_departamento ? 'selected' : '' }}>
                                                            {{ $item->nombre_departamento }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Municipios:</label>
                                                <select name="cod_municipio" id="cod_municipio" class="form-control select-municipios kt-selectpicker" data-size="7" data-live-search="true">
                                                    @if ($form->cod_municipio)
                                                        <option value="">::. Seleccione .::</option>
                                                    @endif
                                                    @foreach ($municipios as $item)
                                                        <option value="{{ $item->cod_municipio }}" {{ $item->cod_municipio == $form->cod_municipio ? 'selected' : '' }}>
                                                            {{ $item->nombre_municipio }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Dirección</label>
                                                <textarea name="dir_usuario" id="dir_usuario" class="form-control" rows="10">{{ $form->dir_usuario }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-primary mx-1">
                            <i class="far fa-save"></i> {{ $btn }}
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
                $('#btn-generate-pass').on('click', function() {
                    var pass = randomPass();
                    $('#password-generated').html('Contraseña generada: <b>' + pass + '</b>');
                    $('#pass_usuario').val(pass);
                    $('#pass_usuario_confirmation').val(pass);
                });

                $('#btn-update-pass').on('click', function() {
                    $('#wrapper-update-pass').remove();
                    $('#wrapper-pass').removeClass('d-none');
                    $('[name="update_pass"]').val('1');
                });

                $('[name="tel_usuario"]').inputmask({
                    "mask": "9",
                    "repeat": 10,
                    "greedy": false
                });

                $('#cod_rol').on('change', function() {
                    var cod_rol = $(this).val();
                    if (cod_rol == 3 || cod_rol == 4) {
                        $('#cod_partido').val('').prop('disabled', true);
                        $('#cod_partido').selectpicker('refresh');
                        $('#cod_departamento').val('').prop('disabled', true);
                        $('#cod_departamento').selectpicker('refresh');
                        $('#cod_municipio').val('').prop('disabled', true);
                        $('#cod_municipio').selectpicker('refresh');
                        $('#tel_usuario').val('').prop('disabled', true);
                        $('#correo_usuario').val('').prop('disabled', true);
                    }

                    if (cod_rol == 2) {
                        $('#wrapper-partidos').removeClass('d-none');
                    } else {
                        $('#wrapper-partidos').addClass('d-none');
                    }
                    $('#cod_partido').val('');
                    $('#cod_partido').selectpicker('refresh');
                });

                $('#dni_usuario').blur(function() {
                    var $this = $(this);

                    if ($this.val().length == 13) {
                        var formData = new FormData();
                        formData.append('dni_usuario', $this.val())

                        axios.post("{{ route('admin.usuarios.dni') }}", formData)
                        .then(function (response) {
                            console.log(response);
                            var data = response.data;

                            if (data.status == 'OK') {
                                $('#nombre_usuario').val(data.data.nombre);
                                $('#tab-direccion').removeClass('d-none');
                            }
                            else {
                                toastr.error(data.message);
                                $this.val('');
                                $this.focus();
                                $('#nombre_usuario').val('');
                                $('#cargo_usuario').val('');
                                $('#tel_usuario').val('');
                                $('#cargo_usuario').val('');
                                $('#pass_usuario').val('');
                                $('#pass_usuario_confirmation').val('');
                                $('#dir_usuario').val('');
                                $('#tab-direccion').addClass('d-none');
                            }
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        });
                    }
                    else {
                        $this.focus();
                        $('#nombre_usuario').val('');
                        $('#cargo_usuario').val('');
                        $('#tel_usuario').val('');
                        $('#cargo_usuario').val('');
                        $('#pass_usuario').val('');
                        $('#pass_usuario_confirmation').val('');
                        $('#dir_usuario').val('');
                        $('#tab-direccion').addClass('d-none');
                    }
                });
            });
        </script>
    @endpush

    @push('styles')
    @endpush
</x-app-layout>
