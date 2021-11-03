<x-guest-layout>
    <div class="d-flex flex-column flex-root">
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
                        <form method="POST" action="{{ route('admin.auth.password.update') }}" class="form form-ajax" id="form" enctype="multipart/form-data" data-return="{{ route('dashboard') }}">
                            @csrf
                            @method('POST')

                            <div class="card card-custom">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Ingrese su nueva contraseña
                                    </h3>
                                </div>
                                <form>
                                    <div class="card-body">
                                        <div class="form-group text-left mb-8">
                                            <div class="alert alert-danger alert-errores d-none mb-1" role="alert"></div>
                                        </div>

                                        <div class="form-group text-left">
                                            <label for="password">Contraseña <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="pass_usuario" placeholder="Contraseña" />
                                        </div>

                                        <div class="form-group text-left">
                                            <label for="password">Confirmar <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="pass_usuario_confirmation" placeholder="Confirmar" />
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                        </form>
                    </div>
                    <!--end::Login Sign in form-->
                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                //  Submit form por ajax
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
</x-guest-layout>
