<x-app-layout>
    <x-slot name="header">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"> Agregar Custodio </h5>
    </x-slot>

    <div class="row">
        <div class="col">

            @if (empty($form))
                <div class="card card-custom my-5">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.custodios.dni') }}">
                            @csrf

                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group m-0">
                                        <label>DNI del postulante a custodio:</label>
                                        <div class="input-group input-group-lg">
                                            <input name="dni" required type="text" class="form-control text-bold" maxlength="13" placeholder="Ingrese el DNI..."/>
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary" type="submit" id="btn-dni">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @if (session()->has('dni_error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('dni_error') }}
                    </div>
                @endif
            @else
                <form method="POST" action="{{ route('admin.custodios.store') }}" class="form">
                    <div class="card card-custom">
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
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3_4">
                                            <span class="nav-icon"><i class="fas fa-image"></i></span>
                                            <span class="nav-text">Fotos</span>
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
                                                    <label>DNI:</label>
                                                    <input type="text" name="dni_custodio" class="form-control form-control-solid" value="{{ $form->dni_custodio }}" readonly />
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Nombre custodio:</label>
                                                    <input type="text" name="nombre_custodio" class="form-control" value="{{ $form->nombre_custodio }}" required />
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
                                                        <input type="text" class="form-control" name="tel_movil" maxlength="25" />
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
                                                    <label for="">{{ 'Correo #1' }}</label>
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
                                                    <label for="">{{ 'Correo #2' }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="far fa-envelope"></i>
                                                            </span>
                                                        </div>
                                                        <input type="email" class="form-control" name="correo2_custodio" maxlength="50" />
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

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Dirección</label>
                                                    <textarea name="dir_custodio" class="form-control" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_3_4" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
                                    ...
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-primary mx-1">
                                <i class="far fa-save"></i> Guadar
                            </button>
                            <a href="{{ route('admin.custodios.index') }}" class="btn btn-secondary mx-1">
                                <i class="fas fa-ban"></i> Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            @endif

        </div>
    </div>

    @push('scripts')
    @endpush

    @push('styles')
    @endpush
</x-app-layout>
