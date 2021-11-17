<x-guest-layout>
    <div class="d-flex flex-column flex-root">
        <div class="col">
            <form action="{{ route('incidencias.guardar') }}" method="POST">
                @csrf

                <div class="alert alert-danger alert-errores d-none mb-1" role="alert"></div>

                <div class="card card-custom example example-compact">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div><h1>HOJA DE INCIDENCIAS</h1><h3>Custodio electoral de centro de votación</h3></div>
                        <div style="position: relative;float: left;"><img style="" src="https://www.cne.hn/assets/img/logo.png"></div>
                    </div>

                    <div class="card-header">
                        <h3 class="card-title">
                            DATOS DEL CUSTODIO
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label style="font-weight:bold">Nombre:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-user"></i></span></div>
                                    <input type="text" name="nombre_custodio" class="form-control" value="{{ $custodio->nombre_custodio }}"  disabled>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label style="font-weight:bold">DNI:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-id-card"></i></span></div>
                                    <input type="text" name="dni_custodio" class="form-control" value="{{ $custodio->dni_custodio }}" disabled />
                                    <input type="hidden" name="idc_custodio" class="form-control" value="{{ $custodio->idc_custodio }}" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label style="font-weight:bold">Celular:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone-alt"></i></span></div>
                                    <input type="text" class="form-control" value="{{ $custodio->tel_movil }}"  disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="" class="card-header">
                        <h3 class="card-title">
                            DATOS DEL CENTRO DE VOTACION
                        </h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label style="font-weight:bold">Departamento:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-location-arrow"></i></span></div>
                                    <input type="text" value="{{ !empty($custodio->departamento->nombre_departamento) ? $custodio->departamento->nombre_departamento : '-' }}"  class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label style="font-weight:bold">Municipio:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-map-marked"></i></span></div>
                                    <input type="text" value="{{ $custodio->municipio->nombre_municipio }}"  class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label style="font-weight:bold">Sector:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-map-marker"></i></span></div>
                                    <input type="text" value="{{ !empty($custodio->centro->nombre_sector_electoral) ? $custodio->centro->nombre_sector_electoral : '-' }}"  class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label style="font-weight:bold">Centro de votación:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-street-view"></i></span></div>
                                    <input type="text" value="{{ !empty($custodio->centro->nombre_centro) ? $custodio->centro->nombre_centro : '-' }}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="" class="card-header">
                        <h2 class="card-title">
                            INSTRUCCIONES:
                        </h2>
                        <p>TODAS las preguntas deben de ser respondidas para obtener el pago final de sus servicios. Terminado el proceso, ingresar esta hoja de
                            incidencias en la primera maleta del centro de votación correspondiente. Tomar fotografía a esta hoja de incidencias una vez la haya
                            llenado, esto para su respaldo. Indique marcando una X en el recuadro “SI” o “NO” según la pregunta. </p>

                        <div style="width:100%;color:#F19600;padding-top:30px"><h3>:: Acreditación y Hojas de Incidencia ::</h3></div>

                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold">1. {{$preguntas['0']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <fieldset id="group0">
                                <div class="radio-inline">
                                    <label class="radio">
                                        <input type="radio" name="group[{{ $preguntas[0]->cod_preg }}]" value="Si" required>
                                        <span></span>
                                        Si
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="group[{{ $preguntas[0]->cod_preg }}]" value="No" required>
                                        <span></span>
                                        No
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold">2. {{$preguntas['1']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <fieldset id="group1">
                                <div class="radio-inline">
                                    <label class="radio">
                                        <input type="radio" name="group[{{ $preguntas[1]->cod_preg }}]" value="Si" required>
                                        <span></span>
                                        Si
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="group[{{ $preguntas[1]->cod_preg }}]" value="No" required>
                                        <span></span>
                                        No
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        <div style="width:100%;padding-top:30px;color:#F19600"><h3>:: Centro de Acopio Municipal::</h3></div>

                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold">3. {{$preguntas['2']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <fieldset id="group2">
                                <div class="radio-inline">
                                    <label class="radio">
                                        <input type="radio" name="group[{{ $preguntas[2]->cod_preg }}]" value="Si" required>
                                        <span></span>
                                        Si
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="group[{{ $preguntas[2]->cod_preg }}]" value="No" required>
                                        <span></span>
                                        No
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold">4. {{$preguntas['3']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[3]->cod_preg }}]" value="Si" required>
                                    <span></span>
                                    Si
                                </label>
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[3]->cod_preg }}]" value="No" required>
                                    <span></span>
                                    No
                                </label>
                            </div>
                        </div>

                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold">5. {{$preguntas['4']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[4]->cod_preg }}]" value="Si" required>
                                    <span></span>
                                    Si
                                </label>
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[4]->cod_preg }}]" value="No" required>
                                    <span></span>
                                    No
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="my-5 py-5 d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
