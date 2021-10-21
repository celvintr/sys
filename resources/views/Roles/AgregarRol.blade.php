<x-app-layout>
    <x-slot name="header">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Tablero  <span style="color:#a1a5b7!important;font-size:.95rem!important"> | Administración - Seguridad - Roles</span></h5>
    </x-slot>

    <div class="row">
        <div class="col">
            <div class="alert alert-danger alert-errores d-none mb-1" role="alert"></div>

			<div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">
                            Agregar nuevo rol
                            <span class="d-block text-muted pt-2 font-size-sm">Agrega y asigna permisos al nuevo rol de usuarios</span>
                        </h3>
                    </div>
			    </div>

				<div class="card-body">
					{!! Form::open([
                        'route'       => 'admin.roles.store',
                        'id'          => 'form',
                        'class'       => 'roles-form',
                        'id'          => 'roles-form',
                        'data-return' => route('admin.roles.index'),
                    ]) !!}

                        {{ csrf_field() }}
                        <div class="form-group">
                            {!! Form::label ('name','Nombre') !!}
                            {!! Form::text ('name',null,['class'=>'form-control','placeholder'=>'','autofocus']) !!}
                        </div>

					    <div class="form-group">
                            <label style='padding-bottom:10px;font-weight:bold'>Seleccione los permisos para el nuevo rol<span class="text-danger">*</span></label>
						    <div class="checkbox-list">
                                @php
                                    $i=1;
                                    $j=1;
                                    $k=1;
                                @endphp

                                @foreach ($permissions as $permission)
                                    @if ($permission->type == 1)
						                @if ($i == 1)
						                    <label style='padding-bottom:10px;font-weight:bold'>Módulo de Administración</label>
                                            @php
                                                ($i++)
                                            @endphp
						                @endif

						                <label class="checkbox">
                                            {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
                                            <span></span>
                                            {{ $permission->description }}
						                </label>
						            @endif

						            @if ($permission->type == 2)
						                @if ($j == 1)
						                    <label style='padding-bottom:10px;font-weight:bold'>Módulo de Seguridad</label>
						                    @php
						                        ($j++)
						                    @endphp
						                @endif

                                        <label class="checkbox">
							                {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
							                <span></span>
							                {{ $permission->description }}
                                        </label>
                                    @endif

                                    @if ($permission->type == 3)
						                @if ($k == 1)
						                    <label style='padding-bottom:10px;font-weight:bold'>Módulo de Custodios</label>
                                            @php
                                                ($k++)
                                            @endphp
						                @endif

						                <label class="checkbox">
							                {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
							                <span></span>
							                {{ $permission->description }}
                                        </label>
                                    @endif
						        @endforeach

						        <div class="card-footer">
							        {!! Form ::submit('Crear rol',['class'=>'btn btn-primary mx-1']) !!}

                                    <button type="submit" class="btn btn-primary mx-1">
                                        <i class="far fa-save"></i> Guadar
                                    </button>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
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
</x-app-layout>
