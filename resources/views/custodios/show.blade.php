<x-app-layout>
    <x-slot name="header">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"> Datos del Custodio </h5>
    </x-slot>

    <div class="row">
        <div class="col">
                <div class="card card-custom">
                    <div class="alert alert-danger alert-errores d-none" role="alert"></div>
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
                                                <input type="text" name="dni_custodio" class="form-control-plaintext form-control-solid" value="{{ $custodio->dni_custodio }}" readonly />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>COD CUSTODIO:</label>
                                                <input type="text" name="cod_custodio" class="form-control-plaintext form-control-solid" value="{{ $custodio->cod_custodio }}" readonly />
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Nombre custodio:</label>
                                                <input type="text" name="nombre_custodio" class="form-control form-control-plaintext" value="{{ $custodio->nombre_custodio }}" readonly />
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Teléfono móvil</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-plaintext" value="{{ $custodio->tel_movil }}" name="tel_movil" maxlength="25" readonly/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Teléfono fijo</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-plaintext" value="{{ $custodio->tel_fijo }}" name="tel_fijo" maxlength="25" readonly />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">{{ 'Correo #1' }}</label>
                                                <div class="input-group">
                                                    <input type="email" class="form-control form-control-plaintext" value="{{ $custodio->correo1_custodio }}" name="correo1_custodio" maxlength="50" readonly />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">{{ 'Correo #2' }}</label>
                                                <div class="input-group">
                                                    <input type="email" class="form-control form-control-plaintext" value="{{ $custodio->correo2_custodio }}" name="correo2_custodio" maxlength="50" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Estado:</label>
                                                <input type="email" class="form-control form-control-plaintext" value="{{ $custodio->estado->nombre_estado }}" name="custodio_estado" maxlength="50" readonly/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Partido Político:</label>
                                                <input type="email" class="form-control form-control-plaintext" value="{{ $custodio->partido->nombre_partido }}" name="custodio_partido" maxlength="50" readonly/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>Tipo de Custodio:</label>
                                                    <input type="text" name="cod_tipo_custodio" id="cod_tipo_custodio" class="form-control-plaintext form-control-solid" value="{{ $custodio->tipoCustodio->tipo_custodio }}" readonly />
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
                                                <input type="email" class="form-control form-control-plaintext" value="{{ $custodio->departamento->nombre_departamento }}" name="custodio_departamento" maxlength="50" readonly/>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group" id="contenedor-centros">
                                                <label>Municipios:</label>
                                                <input type="email" class="form-control form-control-plaintext" value="{{ $custodio->municipio->nombre_municipio }}" name="custodio_municipio" maxlength="50" readonly/>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group" id="contenedor-centros" @if($custodio->cod_tipo_custodio == 2) style="display: none;" @endif>
                                                <label>Centro de Votación:</label>
                                                <input type="email" class="form-control form-control-plaintext" value="{{ $custodio->centro->nombre_centro }}" name="custodio_centro" maxlength="50" readonly/>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Dirección</label>
                                                <textarea name="dir_custodio" class="form-control form-control-plaintext" rows="10" readonly>{{ $custodio->dir_custodio }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="kt_tab_pane_3_4" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
                                <div class="card-body">
                                    <div class="form-row mb-5">
                                        <div class="col-lg-4">
                                            <label class="d-block mb-3 text-center">Foto:</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="image-input image-input-outline" id="kt_foto_custodio">
                                                    <div class="image-input-wrapper" style="background-image: url({{ $custodio->foto }})"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label class="d-block mb-3 text-center">Foto DNI:</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="image-input image-input-outline" id="kt_foto_dni_custodio">
                                                    <div class="image-input-wrapper" style="background-image: url({{ $custodio->foto_dni }}"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label class="d-block mb-3 text-center">Foto Comp.:</label>
                                            <div class="d-flex justify-content-center">
                                                <div class="image-input image-input-outline" id="kt_foto_comp_custodio">
                                                    <div class="image-input-wrapper" style="background-image: url({{ $custodio->foto_comp }})"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
