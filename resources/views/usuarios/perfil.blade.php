<x-app-layout>
    <x-slot name="header">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"> Perfil de usuario </h5>
    </x-slot>

    <div class="row">
        <div class="col">
            <form method="POST" action="{{ route('admin.usuarios.perfil.update') }}" class="form form-ajax" id="form" enctype="multipart/form-data">
                @method('POST')

                <div class="card card-custom">

                    <div class="alert alert-danger alert-errores d-none mb-1" role="alert"></div>

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
                                        <input type="text" name="dni_usuario" class="form-control" value="{{ Auth::user()->dni_usuario }}" maxlength="13" disabled />
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
                                        <input type="text" name="nombre_usuario" class="form-control" value="{{ Auth::user()->nombre_usuario }}" />
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
                                        <input type="text" class="form-control" name="tel_usuario" value="{{ Auth::user()->tel_usuario }}" maxlength="8" />
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
                                        <input type="email" class="form-control" name="correo_usuario" value="{{ Auth::user()->correo_usuario }}" maxlength="50" disabled />
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Cargo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-mobile-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="cargo_usuario" value="{{ Auth::user()->cargo_usuario }}" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Dirección</label>
                                <textarea name="dir_usuario" class="form-control" rows="10">{{ Auth::user()->dir_usuario }}</textarea>
                            </div>
                        </div>

                        <div class="form-row" id="wrapper-update-pass">
                            <div class="col">
                                <input type="hidden" name="update_pass" value="">
                                <button type="button" id="btn-update-pass" class="btn btn-light">
                                    <i class="fas fa-key"></i> Cambiar contraseña
                                </button>
                            </div>
                        </div>

                        <div class="form-row d-none" id="wrapper-pass">
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

                    <div class="card-footer d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-primary mx-1">
                            <i class="far fa-save"></i> Actualizar mi perfil
                        </button>
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
            });
        </script>
    @endpush

    @push('styles')
    @endpush
</x-app-layout>
