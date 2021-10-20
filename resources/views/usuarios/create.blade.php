<x-app-layout>
    <x-slot name="header">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Tablero  <span style="color:#a1a5b7!important;font-size:.95rem!important"> | Administración - Seguridad - Usuarios</span></h5>
    </x-slot>
<form method="POST" action="#" class="form form-ajax" id="form" enctype="multipart/form-data" data-return="http://127.0.0.1:8000/admin/custodios">
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
                                    <input type="text" name="dni_custodio" class="form-control form-control-solid" value="0001099890861" readonly="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nombre custodio:</label>
                                    <input type="text" name="nombre_custodio" class="form-control" value="Mollie Hessel" required="">
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
                                        <input type="text" class="form-control" name="tel_movil" maxlength="25">
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
                                        <input type="text" class="form-control" name="tel_fijo" maxlength="25">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Correo #1</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-envelope"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control" name="correo1_custodio" maxlength="50">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Correo #2</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-envelope"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control" name="correo2_custodio" maxlength="50">
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
                                    <div class="dropdown bootstrap-select form-control select-departamentos kt-"><select name="cod_departamento" id="cod_departamento" class="form-control select-departamentos kt-selectpicker" data-child="#cod_municipio" data-size="7" data-live-search="true">
                                        <option value="">::. Seleccione .::</option>
                                                                                                    <option value="01">Atlantida</option>
                                                                                                    <option value="02">Colon</option>
                                                                                                    <option value="03">Comayagua</option>
                                                                                                    <option value="04">Copan</option>
                                                                                                    <option value="05">Cortes</option>
                                                                                                    <option value="06">Choluteca</option>
                                                                                                    <option value="07">El Paraiso</option>
                                                                                                    <option value="08">Francisco Morazan</option>
                                                                                                    <option value="09">Gracias a Dios</option>
                                                                                                    <option value="10">Intibuca</option>
                                                                                                    <option value="11">Islas de La Bahia</option>
                                                                                                    <option value="12">La Paz</option>
                                                                                                    <option value="13">Lempira</option>
                                                                                                    <option value="14">Ocotepeque</option>
                                                                                                    <option value="15">Olancho</option>
                                                                                                    <option value="16">Santa Barbara</option>
                                                                                                    <option value="17">Valle</option>
                                                                                                    <option value="18">Yoro</option>
                                                                                            </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light bs-placeholder" data-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" data-id="cod_departamento" title="::. Seleccione .::"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">::. Seleccione .::</div></div> </div></button><div class="dropdown-menu "><div class="bs-searchbox"><input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-1" aria-autocomplete="list"></div><div class="inner show" role="listbox" id="bs-select-1" tabindex="-1"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Municipios:</label>
                                    <div class="dropdown bootstrap-select form-control select-municipios kt-"><select name="cod_municipio" id="cod_municipio" class="form-control select-municipios kt-selectpicker" data-child="#cod_centro" data-size="7" data-live-search="true">
                                        <option value="">::. Seleccione .::</option>
                                    </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light bs-placeholder" data-toggle="dropdown" role="combobox" aria-owns="bs-select-2" aria-haspopup="listbox" aria-expanded="false" data-id="cod_municipio" title="::. Seleccione .::"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">::. Seleccione .::</div></div> </div></button><div class="dropdown-menu "><div class="bs-searchbox"><input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-2" aria-autocomplete="list"></div><div class="inner show" role="listbox" id="bs-select-2" tabindex="-1"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Centro de Votación:</label>
                                    <div class="dropdown bootstrap-select form-control select-centros kt-"><select name="cod_centro" id="cod_centro" class="form-control select-centros kt-selectpicker" data-size="7" data-live-search="true">
                                        <option value="">::. Seleccione .::</option>
                                    </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light bs-placeholder" data-toggle="dropdown" role="combobox" aria-owns="bs-select-3" aria-haspopup="listbox" aria-expanded="false" data-id="cod_centro" title="::. Seleccione .::"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">::. Seleccione .::</div></div> </div></button><div class="dropdown-menu "><div class="bs-searchbox"><input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-3" aria-autocomplete="list"></div><div class="inner show" role="listbox" id="bs-select-3" tabindex="-1"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Partido Político:</label>
                                    <div class="dropdown bootstrap-select form-control kt-"><select name="cod_partido" class="form-control kt-selectpicker">
                                        <option value="">::. Seleccione .::</option>
                                                                                                    <option value="1">Partido Libertad y Refundación</option>
                                                                                                    <option value="2">Partido Liberal</option>
                                                                                                    <option value="3">Partido Nacional</option>
                                                                                            </select><button type="button" tabindex="-1" class="btn dropdown-toggle btn-light bs-placeholder" data-toggle="dropdown" role="combobox" aria-owns="bs-select-4" aria-haspopup="listbox" aria-expanded="false" title="::. Seleccione .::"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">::. Seleccione .::</div></div> </div></button><div class="dropdown-menu "><div class="inner show" role="listbox" id="bs-select-4" tabindex="-1"><ul class="dropdown-menu inner show" role="presentation"></ul></div></div></div>
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
                    <div class="card-body">
                        <div class="form-row mb-5">
                            <div class="col-lg-4">
                                <label class="d-block mb-3 text-center">Foto:</label>
                                <div class="d-flex justify-content-center">
                                    <div class="image-input image-input-outline" id="kt_foto_custodio">
                                        <div class="image-input-wrapper" style="background-image: url(https://ui-avatars.com/api/?name=Mollie Hessel&amp;color=7F9CF5&amp;background=EBF4FF)"></div>

                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Cambia foto">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="foto_custodio" accept=".png, .jpg, .jpeg">
                                            <input type="hidden" name="foto_custodio_remove">
                                        </label>

                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancelar foto">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <label class="d-block mb-3 text-center">Foto DNI:</label>
                                <div class="d-flex justify-content-center">
                                    <div class="image-input image-input-outline" id="kt_foto_dni_custodio">
                                        <div class="image-input-wrapper" style="background-image: url(https://ui-avatars.com/api/?name=Mollie Hessel&amp;color=7F9CF5&amp;background=EBF4FF)"></div>

                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Cambia foto DNI">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="foto_dni_custodio" accept=".png, .jpg, .jpeg">
                                            <input type="hidden" name="foto_dni_custodio_remove">
                                        </label>

                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancelar foto DNI">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <label class="d-block mb-3 text-center">Foto Comp.:</label>
                                <div class="d-flex justify-content-center">
                                    <div class="image-input image-input-outline" id="kt_foto_comp_custodio">
                                        <div class="image-input-wrapper" style="background-image: url(https://ui-avatars.com/api/?name=Mollie Hessel&amp;color=7F9CF5&amp;background=EBF4FF)"></div>

                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Cambia foto comp">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="foto_comp_custodio" accept=".png, .jpg, .jpeg">
                                            <input type="hidden" name="foto_comp_custodio_remove">
                                        </label>

                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancelar foto DNI">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer d-flex align-items-center justify-content-center">
            <button type="submit" class="btn btn-primary mx-1">
                <i class="far fa-save"></i> Guadar
            </button>
            <a href="#" class="btn btn-secondary mx-1">
                <i class="fas fa-ban"></i> Cancelar
            </a>
        </div>
    </div>
</form>

</x-app-layout>