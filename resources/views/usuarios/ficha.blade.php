<x-app-layout>
    <x-slot name="header">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"> {{ $title }} </h5>
    </x-slot>

    <div class="row">
        <div class="col">
            <div class="card card-custom">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">DNI</label>
                                <input type="text" readonly class="form-control-plaintext font-weight-bold" value="{{ $form->dni_usuario }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nombre del usuario:</label>
                                <input type="text" readonly class="form-control-plaintext font-weight-bold" value="{{ $form->nombre_usuario }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Teléfono</label>
                                <input type="text" readonly class="form-control-plaintext font-weight-bold" value="{{ $form->tel_usuario }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">{{ 'Correo' }}</label>
                                <input type="text" readonly class="form-control-plaintext font-weight-bold" value="{{ $form->correo_usuario }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Cargo</label>
                                <input type="text" readonly class="form-control-plaintext font-weight-bold" value="{{ $form->cargo_usuario }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Perfil de usuario:</label>
                                <input type="text" readonly class="form-control-plaintext font-weight-bold" value="{{ !empty($form->rol[0]->name) ? $form->rol[0]->name : '' }}">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Partido:</label>
                                <input type="text" readonly class="form-control-plaintext font-weight-bold" value="{{ empty($form->partido->nombre_partido) ? '-' : $form->partido->nombre_partido }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Departamento:</label>
                                <input type="text" readonly class="form-control-plaintext font-weight-bold" value="{{ empty($form->departamento->nombre_departamento) ? '-' : $form->departamento->nombre_departamento }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Municipio:</label>
                                <input type="text" readonly class="form-control-plaintext font-weight-bold" value="{{ empty($form->municipio->nombre_municipio) ? '-' : $form->municipio->nombre_municipio }}">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Dirección</label>
                                <textarea readonly class="form-control-plaintext font-weight-bold" rows="10">{{ $form->dir_usuario }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex align-items-center justify-content-center">
                    <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary mx-1">
                        <i class="fas fa-undo-alt"></i> Regresar
                    </a>
                    <a href="{{ route('admin.usuarios.ficha.imprimir', $form->dni_usuario) }}" class="btn btn-primary mx-1">
                        <i class="fas fa-file-pdf"></i> Imprimir
                    </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
