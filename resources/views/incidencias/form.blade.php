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
                            <div class="col-lg-4">
                                <label style="font-weight:bold">Cantidad de Junta(s) que atendió:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-street-view"></i></span></div>
                                    <input type="number" value="0" name="group[{{ $preguntas[35]->cod_preg }}]" class="form-control" required>
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
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-lg-3 col-sm-12"> Seleccione la fecha y hora</label>
                                        <div class="col-lg-9 col-sm-12">
                                            <div class="input-group date" id="kt_datetimepicker_2" data-target-input="nearest">
                                                <input type="text" name="group[{{ $preguntas[2]->cod_preg }}]" class="form-control datetimepicker-input" placeholder="Seleccione " data-target="#kt_datetimepicker_2" required />
                                                <div class="input-group-append" data-target="#kt_datetimepicker_2" data-toggle="datetimepicker">
                                                    <span class="input-group-text">
                                                        <i class="ki ki-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                        <div style="width:100%;padding-top:30px;color:#F19600"><h3>:: Recepción de la Maleta Electoral en el Centro de Acopio Municipal::</h3></div>

                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold">6. {{$preguntas['5']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[5]->cod_preg }}]" value="Si" required>
                                    <span></span>
                                    Si
                                </label>
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[5]->cod_preg }}]" value="No" required>
                                    <span></span>
                                    No
                                </label>
                            </div>
                        </div>

                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold">7. {{$preguntas['8']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[8]->cod_preg }}]" value="Si" required>
                                    <span></span>
                                    Si
                                </label>
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[8]->cod_preg }}]" value="No" required>
                                    <span></span>
                                    No
                                </label>
                            </div>
                        </div>

                        <div style="width:100%;padding-top:30px;color:#F19600"><h3>:: Entrega de la Maleta Electoral y kits tecnológicos en el Centro de Votación ::</h3></div>

                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold">8. {{$preguntas['9']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <fieldset id="group2">
                                <div class="radio-inline">
                                        <div class="form-group row">
                                            <label class="col-form-label text-right col-lg-3 col-sm-12"> Seleccione la fecha y hora</label>
                                            <div class="col-lg-9 col-sm-12">
                                                <div class="input-group date" id="kt_datetimepicker_9" data-target-input="nearest">
                                                    <input type="text" name="group[{{ $preguntas[9]->cod_preg }}]" class="form-control datetimepicker-input" placeholder="Seleccione " data-target="#kt_datetimepicker_9" required />
                                                    <div class="input-group-append" data-target="#kt_datetimepicker_9" data-toggle="datetimepicker">
                                                        <span class="input-group-text">
                                                            <i class="ki ki-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                </div>
                            </fieldset>
                        </div>



                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold">9. {{$preguntas['10']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[10]->cod_preg }}]" value="Si" required>
                                    <span></span>
                                    Si
                                </label>
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[10]->cod_preg }}]" value="No" required>
                                    <span></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold">10. {{$preguntas['11']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[11]->cod_preg }}]" value="Si" required>
                                    <span></span>
                                    Si
                                </label>
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[11]->cod_preg }}]" value="No" required>
                                    <span></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold">11. {{$preguntas['12']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[12]->cod_preg }}][0]" value="Si" required>
                                    <span></span>
                                    Si
                                </label>
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[12]->cod_preg }}][0]" value="No" required>
                                    <span></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold"> {{$preguntas['13']->pregunta}}</p></div>

                        <div style="" class="col-9 col-form-label">
                            <fieldset id="group2">
                                <div class="radio-inline">
                                    <div class="form-group row">
                                        <label class="col-form-label text-right col-lg-3 col-sm-12"> Seleccione la hora</label>
                                        <div class="col-lg-9 col-sm-12">
                                            <div class="input-group date"  data-target-input="nearest">
                                                <input class="form-control" value="" id="kt_timepicker_1" readonly placeholder="Selecciona la hora" type="text"  name="group[{{ $preguntas[12]->cod_preg }}][1]" />
                                                    <span class="input-group-text">
                                                        <i class="ki ki-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div style="width:100%;padding-top:30px;color:#F19600"><h3>:: Kit de Bioseguridad ::</h3></div>
                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold">12. {{$preguntas['14']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[14]->cod_preg }}]" value="Si" required>
                                    <span></span>
                                    Si
                                </label>
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[14]->cod_preg }}]" value="No" required>
                                    <span></span>
                                    No
                                </label>
                            </div>
                        </div>
                         <div style="padding-top:10px;width:100%"><p style="font-weight:bold">13. {{$preguntas['15']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[15]->cod_preg }}]" value="Si" required>
                                    <span></span>
                                    Si
                                </label>
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[15]->cod_preg }}]" value="No" required>
                                    <span></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold">14. {{$preguntas['16']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[16]->cod_preg }}]" value="Si" required>
                                    <span></span>
                                    Si
                                </label>
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[16]->cod_preg }}]" value="No" required>
                                    <span></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold">15. {{$preguntas['17']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[17]->cod_preg }}]" value="Si" required>
                                    <span></span>
                                    Si
                                </label>
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[17]->cod_preg }}]" value="No" required>
                                    <span></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold">16. {{$preguntas['18']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[18]->cod_preg }}]" value="Si" required>
                                    <span></span>
                                    Si
                                </label>
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[18]->cod_preg }}]" value="No" required>
                                    <span></span>
                                    No
                                </label>
                            </div>
                        </div>
                        <div style="padding-top:10px;width:100%"><p style="font-weight:bold">17. {{$preguntas['19']->pregunta}}</p></div>
                        <div style="" class="col-9 col-form-label">
                            <div class="radio-inline">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-info"></i></span></div>
                                    <input type="text" name="group[{{ $preguntas[19]->cod_preg }}]"  class="form-control" value="">
                                </div>
                            </div>
                        </div>

                        <div style="width:100%;padding-top:30px;color:#F19600"><h3>:: Call Center
                            ::</h3></div>
                            <div style="padding-top:10px;width:100%"><p style="font-weight:bold">18. {{$preguntas['20']->pregunta}}</p></div>

                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[20]->cod_preg }}][0]" value="Si">
                                    <span></span>
                                    Si
                                </label>

                                <label class="radio">
                                    <input type="radio" name="group[{{ $preguntas[20]->cod_preg }}][0]" value="No">
                                    <span></span>
                                    No
                                </label>

                                <div style="padding-top:10px;width:100%"><p style="font-weight:bold">{{$preguntas['21']->pregunta}}</p></div>

                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="la la-number"></i></span></div>
                                    <input type="number" name="group[{{ $preguntas[20]->cod_preg }}][1]"  class="form-control">
                                </div>
                            </div>

                            <div style="padding-top:10px;width:100%"><p style="font-weight:bold">19. {{$preguntas['22']->pregunta}}</p></div>
                            <div style="" class="col-2 col-form-label">
                                <div class="radio-inline">
                                    Minutos:
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-clock"></i></span></div>
                                        <input type="number" name="group[{{ $preguntas[22]->cod_preg }}]"  class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div style="padding-top:10px;width:100%"><p style="font-weight:bold">20. {{$preguntas['23']->pregunta}}</p></div>
                            <div style="" class="col-lg-9 col-form-label">
                                <div class="form-row mb-5">
                                    <div class="col-lg-8">
                                        <div class="radio-inline">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-info"></i></span></div>
                                                <input type="text" name="group[{{ $preguntas[23]->cod_preg }}][0][0]"  class="form-control" placeholder="Escriba su respuesta">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div><p class="m-0" style="font-weight:bold">{{$preguntas['24']->pregunta}}</p></div>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" name="group[{{ $preguntas[23]->cod_preg }}][0][1]" value="Si">
                                                <span></span>
                                                Si
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="group[{{ $preguntas[23]->cod_preg }}][0][1]" value="No">
                                                <span></span>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row mb-5">
                                    <div class="col-lg-8">
                                        <div class="radio-inline">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-info"></i></span></div>
                                                <input type="text" name="group[{{ $preguntas[23]->cod_preg }}][1][0]"  class="form-control" placeholder="Escriba su respuesta">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div><p class="m-0" style="font-weight:bold">{{$preguntas['24']->pregunta}}</p></div>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" name="group[{{ $preguntas[23]->cod_preg }}][1][1]" value="Si">
                                                <span></span>
                                                Si
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="group[{{ $preguntas[23]->cod_preg }}][1][1]" value="No">
                                                <span></span>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row mb-5">
                                    <div class="col-lg-8">
                                        <div class="radio-inline">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-info"></i></span></div>
                                                <input type="text" name="group[{{ $preguntas[23]->cod_preg }}][2][0]"  class="form-control" placeholder="Escriba su respuesta">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div><p class="m-0" style="font-weight:bold">{{$preguntas['24']->pregunta}}</p></div>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" name="group[{{ $preguntas[23]->cod_preg }}][2][1]" value="Si">
                                                <span></span>
                                                Si
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="group[{{ $preguntas[23]->cod_preg }}][2][1]" value="No">
                                                <span></span>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style="width:100%;padding-top:30px;color:#F19600"><h3>:: Cierre de la Votación
                                ::</h3></div>

                                <div style="padding-top:10px;width:100%"><p style="font-weight:bold">21. {{$preguntas['27']->pregunta}}</p></div>
                                <div style="" class="col-9 col-form-label">
                                    <fieldset id="group2">
                                        <div class="radio-inline">
                                                <div class="form-group row">
                                                    <label class="col-form-label text-right col-lg-3 col-sm-12"> Seleccione la fecha y hora</label>
                                                    <div class="col-lg-9 col-sm-12">
                                                        <div class="input-group date" id="kt_datetimepicker_11" data-target-input="nearest">
                                                            <input type="text" name="group[{{ $preguntas[27]->cod_preg }}]" class="form-control datetimepicker-input" placeholder="Seleccione " data-target="#kt_datetimepicker_11" required />
                                                            <div class="input-group-append" data-target="#kt_datetimepicker_11" data-toggle="datetimepicker">
                                                                <span class="input-group-text">
                                                                    <i class="ki ki-calendar"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                    </fieldset>
                                </div>
                                <div style="padding-top:10px;width:100%"><p style="font-weight:bold">22. {{$preguntas['28']->pregunta}}</p></div>
                                <div style="" class="col-9 col-form-label">
                                    <fieldset id="group2">
                                        <div class="radio-inline">
                                                <div class="form-group row">
                                                    <label class="col-form-label text-right col-lg-3 col-sm-12"> Seleccione la fecha y hora</label>
                                                    <div class="col-lg-9 col-sm-12">
                                                        <div class="input-group date" id="kt_datetimepicker_12" data-target-input="nearest">
                                                            <input type="text" name="group[{{ $preguntas[28]->cod_preg }}]" class="form-control datetimepicker-input" placeholder="Seleccione " data-target="#kt_datetimepicker_12" required />
                                                            <div class="input-group-append" data-target="#kt_datetimepicker_12" data-toggle="datetimepicker">
                                                                <span class="input-group-text">
                                                                    <i class="ki ki-calendar"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                    </fieldset>
                                </div>
                                <div style="width:100%;padding-top:30px;color:#F19600"><h3>:: Retorno de la Maleta Electoral y kits tecnológicos::</h3></div>
                                    <div style="padding-top:10px;width:100%"><p style="font-weight:bold">23. {{$preguntas['29']->pregunta}}</p></div>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" name="group[{{ $preguntas[29]->cod_preg }}][0]" value="Si">
                                            <span></span>
                                            Si
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="group[{{ $preguntas[29]->cod_preg }}][0]" value="No">
                                            <span></span>
                                            No
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i class="la la-number"></i></span></div>
                                            <input type="number" name="group[{{ $preguntas[29]->cod_preg }}][1]"  class="form-control">
                                        </div>
                                    </div>

                                    <div style="padding-top:10px;width:100%"><p style="font-weight:bold">24. {{$preguntas['31']->pregunta}}</p></div>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" name="group[{{ $preguntas[31]->cod_preg }}]" value="Si">
                                            <span></span>
                                            Si
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="group[{{ $preguntas[31]->cod_preg }}]" value="No">
                                            <span></span>
                                            No
                                        </label>
                                    </div>
                                    <div style="padding-top:10px;width:100%"><p style="font-weight:bold">25. {{$preguntas['32']->pregunta}}</p></div>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" name="group[{{ $preguntas[32]->cod_preg }}][0]" value="Si">
                                            <span></span>
                                            Si
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="group[{{ $preguntas[32]->cod_preg }}][0]" value="No">
                                            <span></span>
                                            No
                                        </label>
                                           <div style="padding-top:10px;width:100%"><p style="font-weight:bold">{{$preguntas['33']->pregunta}}</p></div>

                                        <div class="input-group">

                                             <input type="number" name="group[{{ $preguntas[32]->cod_preg }}][1]"  class="form-control">

                                    </div>
                                    </div>
                                    <div style="padding-top:10px;width:100%"><p style="font-weight:bold">26. {{$preguntas['34']->pregunta}}</p></div>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" name="group[{{ $preguntas[34]->cod_preg }}]" value="Si">
                                            <span></span>
                                            Si
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="group[{{ $preguntas[34]->cod_preg }}]" value="No">
                                            <span></span>
                                            No
                                        </label>

                                    </div>

                    </div>
                </div>

                <div class="my-5 py-5 d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>


@push('scripts')
<script>
$('.datetimepicker-input').datetimepicker();
$('#kt_timepicker_1').timepicker({
			defaultTime: ''
		});
</script>
    @endpush
</x-guest-layout>
