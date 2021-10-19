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
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-3" :status="session('status')" />

                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-3" :errors="$errors" />
                        </div>

                        <form method="POST" action="{{ route('login') }}" class="form" id="kt_login_signin_form">
                            @csrf

                            <div class="form-group mb-5">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="DNI" name="dni_usuario" maxlength="13" autocomplete="off" value="{{ old('dni_usuario') }}" autofocus />
                            </div>

                            <div class="form-group mb-5">
                                <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Contraseña" name="pass_usuario" autocomplete="current-password" />
                            </div>

                            <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">Iniciar Sesión</button>
                        </form>
                    </div>
                    <!--end::Login Sign in form-->
                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>
</x-guest-layout>
