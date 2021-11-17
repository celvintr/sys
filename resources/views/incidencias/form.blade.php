<x-guest-layout>
    <div class="d-flex flex-column flex-root">

      <div class="col">
          <div class="alert alert-danger alert-errores d-none mb-1" role="alert"></div>

          <div class="card card-custom example example-compact">
              <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div><h1>HOJA DE INCIDENCIAS</h1><h3>Custodio electoral de centro de votación
              </h3></div>
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
                              <input type="text" value="{{ $custodio->departamento->nombre_departamento }}"  class="form-control" disabled>
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
                              <input type="text" value="{{ $custodio->centro->nombre_sector_electoral }}"  class="form-control" disabled>
                          </div>
                          
                      </div>
                      <div class="col-lg-4">
                          <label style="font-weight:bold">Centro de votación:</label>
                          <div class="input-group">
                              <div class="input-group-prepend"><span class="input-group-text"><i class="la la-street-view"></i></span></div>
                              <input type="text" value="{{ $custodio->centro->nombre_centro }}" class="form-control" disabled>
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
                      <div style="width:100%;color:#F19600;padding-top:30px"><h3>:: Acreditación y Hojas de Incidencia 
::</h3></div>
                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">1. {{$preguntas['0']->pregunta}}</p></div>
                 
                      <div style="" class="col-9 col-form-label">
                          <div style="" class="col-9 col-form-label">
                          <fieldset id="group0">
                              <div class="radio-inline">         
                              <label class="radio">
                                  <input type="radio" name="group0">
                                  <span></span>
                                 Si
                              </label>
                              <label class="radio">
                                  <input type="radio" name="group0">
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
                                  <input type="radio" name="group1">
                                  <span></span>
                                 Si
                              </label>
                              <label class="radio">
                                  <input type="radio" name="group1">
                                  <span></span>
                                No
                              </label>                     
                          </div>     
                          </fieldset>       
                      </div>

                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">3. {{$preguntas['2']->pregunta}}</p></div>                 
                      <div style="" class="col-9 col-form-label">
                          <fieldset id="group2">
                              <div class="radio-inline">                     
                              <label class="radio">
                                  <input type="radio" name="group2">
                                  <span></span>
                                 Si
                              </label>
                              <label class="radio">
                                  <input type="radio" name="group2">
                                  <span></span>
                                No
                              </label>
                         </div>
                      </fieldset>
                      </div>

                      <div style="width:100%;padding-top:30px;color:#F19600"><h3>:: Acreditación y Hojas de Incidencia ::</h3></div>
                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">4. {{$preguntas['3']->pregunta}}</p></div>                 
                      <div style="" class="col-9 col-form-label">
                          <div class="radio-inline">
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                 Si
                              </label>
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                No
                              </label>
                         </div>
                       
                      </div>
                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">5. {{$preguntas['4']->pregunta}}</p></div>                 
                      <div style="" class="col-9 col-form-label">
                          <div class="radio-inline">
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                 Si
                              </label>
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                No
                              </label>
                         </div>            
                      </div>

                      <!-- RECEPCION MESA ELECTORAL-->
                      <div style="width:100%;padding-top:30px;color:#F19600"><h3>:: Recepción de la Maleta Electoral ::</h3></div>
                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">6. {{$preguntas['5']->pregunta}}</p></div>                 
                      <div style="" class="col-9 col-form-label">
                          <div class="radio-inline">
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                 Si
                              </label>
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                No
                              </label>
                         </div>                       
                      </div>

                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">7. {{$preguntas['6']->pregunta}}</p></div>                 
                      <div style="" class="col-9 col-form-label">
                          <div class="radio-inline">
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                 Si
                              </label>
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                No
                              </label>
                         </div>                       
                      </div>

                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">8. {{$preguntas['7']->pregunta}}</p></div>                 
                      <div style="" class="col-9 col-form-label">
                          <div class="radio-inline">
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                 Si
                              </label>
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                No
                              </label>
                         </div>                       
                      </div>

                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">9. {{$preguntas['8']->pregunta}}</p></div>                 
                      <div style="" class="col-9 col-form-label">
                          <div class="radio-inline">
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                 Si
                              </label>
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                No
                              </label>
                         </div>                       
                      </div>

                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">10. {{$preguntas['9']->pregunta}}</p></div>                 
                      <div style="" class="col-9 col-form-label">
                          <div class="radio-inline">
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                 Si
                              </label>
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                No
                              </label>
                         </div>                       
                      </div>
                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">11. {{$preguntas['10']->pregunta}}</p></div>                 
                      <div class="card-body">
                          <div class="form-group row">
                              <div class="col-lg-4">
                                  <div style="padding-bottom:15px" class="input-group">
                                      <div class="input-group-prepend">
                                          <button class="btn btn-primary" type="button">A)</button>
                                      </div>
                                      <input type="text" class="form-control" placeholder="">
                                  </div>
                              </div>
                              <div class="col-lg-4">
                                  <div style="padding-bottom:15px" class="input-group">
                                      <div class="input-group-prepend">
                                          <button class="btn btn-primary" type="button">B)</button>
                                      </div>
                                      <input type="text" class="form-control" placeholder="">
                                  </div>
                              </div>
                              <div class="col-lg-4">
                                  <div style="padding-bottom:15px" class="input-group">
                                      <div class="input-group-prepend">
                                          <button class="btn btn-primary" type="button">C)</button>
                                      </div>
                                      <input type="text" class="form-control" placeholder="">
                                  </div>
                              </div>
                              <div class="col-lg-4">
                                  <div style="padding-bottom:15px" class="input-group">
                                      <div class="input-group-prepend">
                                          <button class="btn btn-primary" type="button">D)</button>
                                      </div>
                                      <input type="text" class="form-control" placeholder="">
                                  </div>
                              </div>
                              <div class="col-lg-4">
                                  <div style="padding-bottom:15px" class="input-group">
                                      <div class="input-group-prepend">
                                          <button class="btn btn-primary" type="button">E)</button>
                                      </div>
                                      <input type="text" class="form-control" placeholder="">
                                  </div>
                              </div>
                              <div class="col-lg-4">
                                  <div class="input-group">
                                      <div class="input-group-prepend">
                                          <button class="btn btn-primary" type="button">F)</button>
                                      </div>
                                      <input type="text" class="form-control" placeholder="">
                                  </div>
                              </div>
                          </div>                                         
                      </div>

                      <!-- Kit de bioseguridad-->
                      <div style="width:100%;padding-top:30px;color:#F19600"><h3>:: Kit de Bioseguridad ::</h3></div>
                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">12. {{$preguntas['11']->pregunta}}</p></div>                 
                      <div style="" class="col-9 col-form-label">
                          <div class="radio-inline">
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                 Si
                              </label>
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                No
                              </label>
                         </div>                       
                      </div>

                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">13. {{$preguntas['12']->pregunta}}</p></div>                 
                      <div style="" class="col-9 col-form-label">
                          <div class="radio-inline">
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                 Si
                              </label>
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                No
                              </label>
                         </div>                       
                      </div>

                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">14. {{$preguntas['13']->pregunta}}</p></div>                 
                      <div style="" class="col-9 col-form-label">
                          <div class="radio-inline">
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                 Si
                              </label>
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                No
                              </label>
                         </div>                       
                      </div>

                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">15. {{$preguntas['14']->pregunta}}</p></div>                 
                      <div style="" class="col-9 col-form-label">
                          <div class="radio-inline">
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                 Si
                              </label>
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                No
                              </label>
                         </div>                       
                      </div>

                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">16. {{$preguntas['15']->pregunta}}</p></div>                 
                      <div style="" class="col-9 col-form-label">
                          <div class="radio-inline">
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                 Si
                              </label>
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                No
                              </label>
                         </div>                       
                      </div>

                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">17. {{$preguntas['16']->pregunta}}</p></div>                 
                      <div style="" class="col-9 col-form-label">
                          <div style="width:80%"><textarea name="dir_usuario" class="form-control" rows="6"></textarea></div>                   
                      </div>
                      
                      <!--CALL CENTER-->
                      <div style="width:100%;padding-top:30px;color:#F19600"><h3>:: Call Center ::</h3></div>
                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">18. {{$preguntas['17']->pregunta}}</p></div>                 
                      <div style="" class="col-9 col-form-label">
                          <div class="radio-inline">
                              <label class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                 Si
                              </label>
                              <div style="width:200px"  class="input-group">
                                  <div class="input-group-prepend">
                                      <button class="btn btn-primary" type="button">¿Cuántas veces?</button>
                                  </div>
                                  <input type="text" class="form-control" placeholder="">
                              </div>
                              <label style="padding-left:40px" class="radio">
                                  <input type="radio" name="radios5">
                                  <span></span>
                                No
                              </label>
                         </div>                       
                      </div>

                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">19. {{$preguntas['18']->pregunta}}</p></div>                 
                      <div class="col-9 col-form-label">
                          <div style="width:170px;padding-right:20px"  class="input-group">
                              <div class="input-group-prepend">
                                  <button class="btn btn-primary" type="button">Minutos:</button>
                              </div>
                              <input type="text" class="form-control" placeholder="">
                          </div>                   
                      </div>
                      
                      <div style="padding-top:10px;width:100%"><p style="font-weight:bold">20. {{$preguntas['19']->pregunta}}</p></div>
                      <div class="col-9 col-form-label">
                          <div style="padding-right:20px"  class="input-group">
                              <div class="input-group-prepend">
                                  <button class="btn btn-primary" type="button">1. </button>
                              </div>
                              <input type="text" class="form-control" placeholder="">
                          </div>                   
                      </div>
                      <div class="col-9 col-form-label">
                          <div style="padding-right:20px"  class="input-group">
                              <div class="input-group-prepend">
                                  <button class="btn btn-primary" type="button">2. </button>
                              </div>
                              <input type="text" class="form-control" placeholder="">
                          </div>                   
                      </div>
                      <div class="col-9 col-form-label">
                          <div style="padding-right:20px"  class="input-group">
                              <div class="input-group-prepend">
                                  <button class="btn btn-primary" type="button">3. </button>
                              </div>
                              <input type="text" class="form-control" placeholder="">
                          </div>                   
                      </div>

          </div>
      </div>
  </div>

  @push('scripts')
      <script>
          $(document).ready(function() {
              //  Submit form por ajax
              $('.roles-form').on('submit', function(e) {
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
                      }else if(data.exist_rol){
                          $('.alert-errores').removeClass('d-none');
                          $('.alert-errores').append(`<p>${data.exist_rol}</p>`);
                      } 
                      else {
                          Swal.fire({
                              title: "Agregado",
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
