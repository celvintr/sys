<x-guest-layout>
    <div class="d-flex flex-column flex-root">
        <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat py-5" style="background-image: url('{{ asset('metronic/media/bg/bg-3.jpg') }}');">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <div class="card card-custom my-5">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Incidencias
                                    </h3>
                                </div>
                                <form method="POST" action="{{ route('incidencias.guardar') }}">
                                    @method('POST')
                                    @csrf

                                    <div class="card-body">
                                        <div class="form-group mb-8">
                                            <!-- Validation Errors -->
                                            <x-auth-validation-errors class="mb-3" :errors="$errors" />
                                        </div>

                                        <div class="form-group">
                                            <label>DNI:</label>
                                            <input type="text" name="dni_custodio" class="form-control-plaintext font-weight-bold" value="{{ $custodio->dni_custodio }}" />
                                        </div>

                                        <div class="form-group">
                                            <label>Nombre <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nombre_custodio" placeholder="Nombre" value="{{ $custodio->nombre_custodio }}" />
                                        </div>

                                        <div class="form-group">
                                            <label>Correo <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="correo1_custodio" placeholder="Correo" value="{{ $custodio->correo1_custodio }}" />
                                        </div>

                                        <div class="form-group">
                                            <label>Número de teléfono <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="tel_movil" placeholder="Número de teléfono" value="{{ $custodio->tel_movil }}" />
                                        </div>
                                    </div>

                                    <div class="card-footer d-flex justify-content-center align-items-center">
                                        <button type="submit" class="btn btn-primary mx-2">
                                            <i class="fas fa-paper-plane"></i> Enviar
                                        </button>
                                        <a href="{{ route('login') }}" class="btn btn-light mx-2">
                                            <i class="fas fa-ban"></i> Salir
                                        </a>
                                    </div>
                                </form>
                                <!--end::Form-->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>
