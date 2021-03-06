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
                                        <input type="text" name="nombre_usuario" class="form-control" value="{{ Auth::user()->nombre_usuario }}" disabled />
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Tel??fono</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-mobile-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" name="tel_usuario" value="{{ Auth::user()->tel_usuario }}" maxlength="8" disabled />
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
                                        <input type="text" class="form-control" name="cargo_usuario" value="{{ Auth::user()->cargo_usuario }}" disabled />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Direcci??n</label>
                                <textarea name="dir_usuario" class="form-control" rows="10" disabled>{{ Auth::user()->dir_usuario }}</textarea>
                            </div>
                        </div>

                        <div class="form-row" id="wrapper-pass">
                            <div class="col-lg-6">
                                <div class="d-flex align-items-center">
                                    <input type="hidden" name="update_pass" value="1">
                                    <div class="form-group w-100 mr-1">
                                        <label for="">{{ 'Contrase??a' }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-key"></i>
                                                </span>
                                            </div>
                                            <input class="form-control" type="password" placeholder="Contrase??a" name="pass_usuario" id="pass_usuario" autocomplete="current-password" />
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
                                    <label for="">{{ 'Confirmar Contrase??a' }}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-key"></i>
                                            </span>
                                        </div>
                                        <input class="form-control" type="password" placeholder="Contrase??a" name="pass_usuario_confirmation" id="pass_usuario_confirmation" />
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
                            <i class="far fa-save"></i> Actualizar Contrase??a
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
                    $('#password-generated').html('Contrase??a generada: <b>' + pass + '</b>');
                    $('#pass_usuario').val(pass);
                    $('#pass_usuario_confirmation').val(pass);
                });
            });
        </script>
    @endpush

    @push('styles')
    @endpush
</x-app-layout>
