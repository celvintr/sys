<x-app-layout>
    <x-slot name="header">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"> Actualizar Contraseña </h5>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-6">
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
                            <div class="form-group mb-8">
                                <div class="alert alert-danger alert-errores d-none mb-1" role="alert"></div>
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="pass_usuario" placeholder="Contraseña" />
                            </div>

                            <div class="form-group">
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
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
            });
        </script>
    @endpush

    @push('styles')
    @endpush
</x-app-layout>
