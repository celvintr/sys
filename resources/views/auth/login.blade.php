<x-guest-layout>
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ asset('metronic/media/bg/bg-3.jpg') }}');">
                <div class="login-form text-center p-7 position-relative overflow-hidden">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-15">
                        <a href="#">
                            <img src="{{ asset('metronic/media/logos/logo-letter-13.png') }}" class="max-h-75px" alt="" />
                        </a>
                    </div>
                    <!--end::Login Header-->

                    <!--begin::Login Sign in form-->
                    <div class="login-signin">
                        <div class="mb-20">

                           <h4> Sistema de gestión de custodios electorales </h4>
                            <h4>Iniciar Sesión</h4>
                            <div class="text  font-weight-bold">Por favor ingrese sus credenciales:</div>
                        </div>

                        <div>
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('message') }}
                                </div>
                            @endif

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-3" :status="session('status')" />

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-3" :errors="$errors" />
                        </div>


                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ old('dni_custodio') ? '' : 'active' }}" id="home-tab" data-toggle="tab" href="#home">
                                    <span class="nav-icon"><i class="flaticon2-lock"></i></span>
                                    <span class="nav-text">Login</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ old('dni_custodio') ? 'active' : '' }}" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile">
                                    <span class="nav-icon"><i class="flaticon2-user"></i></span>
                                    <span class="nav-text">Custodio</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content mt-5" id="myTabContent">
                            <div class="tab-pane fade {{ old('dni_custodio') ? '' : 'show active' }}" id="home" role="tabpanel" aria-labelledby="home-tab" style="height: 225px;">

                                <form method="POST" action="{{ route('login') }}" class="form" id="kt_login_signin_form">
                                    @csrf

                                    <div class="form-group mb-5">
                                        <input class="form-control h-auto form-control-solid py-4 px-8 mask-dni" type="text" placeholder="DNI" name="dni_usuario" maxlength="13" autocomplete="off" value="{{ old('dni_usuario') }}" autofocus />
                                    </div>

                                    <div class="form-group mb-5">
                                        <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Contraseña" name="pass_usuario" autocomplete="current-password" />
                                    </div>

                                    <div class="d-flex justify-content-end my-4">
                                        <a href="{{ route('forget.password.get') }}" class="text-dark">Olvidó su contraseña?</a>
                                    </div>

                                    <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Iniciar Sesión</button>
                                </form>

                            </div>

                            <div class="tab-pane fade {{ old('dni_custodio') ? 'show active' : '' }}" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="height: 225px;">

                                <form method="POST" action="{{ route('incidencias.dni') }}" class="form" id="kt_login_custodio_form">
                                    @csrf

                                    <div class="form-group mb-5">
                                        <input class="form-control h-auto form-control-solid py-4 px-8 mask-dni" type="text" placeholder="DNI" name="dni_custodio" id="dni_custodio" maxlength="13" autocomplete="off" value="{{ old('dni_custodio') }}" autofocus />
                                    </div>

                                    <div class="form-group mb-5">
                                        <input class="form-control h-auto form-control-solid py-4 px-8 mask-date" type="text" placeholder="Fecha de nacimiento" name="fechanac_custodio" id="fechanac_custodio" maxlength="10" autocomplete="off" value="{{ old('fechanac_custodio') }}" />
                                    </div>

                                    <button id="kt_login_custodio_submit" class="btn btn-success font-weight-bold px-9 py-4 my-3 mx-4">Buscar DNI</button>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!--end::Login Sign in form-->
                </div>
            </div>
        </div>
        <!--end::Login-->

        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('.mask-date').datepicker({
                        rtl: KTUtil.isRTL(),
                        todayHighlight: true,
                        orientation: "bottom left",
                        format: 'dd/mm/yyyy',
                        templates: {
                            leftArrow: '<i class="la la-angle-left"></i>',
                            rightArrow: '<i class="la la-angle-right"></i>'
                        }
                    });

                    $(".mask-date").inputmask("99/99/9999", {
                        "placeholder": "dd/mm/yyyy",
                        autoUnmask: true
                    });

                    $('.mask-dni').inputmask("9999999999999");
                   
                });
            </script>
        @endpush
    </div>
</x-guest-layout>
