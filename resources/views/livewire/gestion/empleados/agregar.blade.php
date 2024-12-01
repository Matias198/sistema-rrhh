<div>
    <form wire:submit.prevent="contratarEmpleado">
        <div wire:ignore.self class="bs-stepper">
            <div wire:ignore class="bs-stepper-header" role="tablist">

                <!-- PRIMER HEADER -->
                <div class="step" data-target="#datos-personales">
                    <button type="button" class="step-trigger" role="tab" aria-controls="datos-personales"
                        id="datos-personales-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Datos Personales</span>
                    </button>
                </div>
                <div class="line"></div>

                <!-- SEGUNDO HEADER -->
                <div class="step" data-target="#datos-legajo">
                    <button type="button" class="step-trigger" role="tab" aria-controls="datos-legajo"
                        id="datos-legajo-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Datos del Puesto de Trabajo</span>
                    </button>
                </div>
            </div>


            <!-- PRIMER STEP -->
            <div wire:ignore.self class="bs-stepper-content">
                <div wire:ignore.self id="datos-personales" class="content" role="tabpanel"
                    aria-labelledby="datos-personales-trigger">

                    <!-- DATOS PERSONALES -->

                    <div class="card card-primary">
                        <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                            <h3 class="card-title">Datos Personales</h3>
                            <div class="card-tools">
                                <a type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                                </a>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="nombre">Nombre</label>
                                    <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                        title="Campo obligatorio">*</span>
                                    <input wire:model="nombre" type="text" name="nombre" id="nombre"
                                        class="form-control @if (!$errors->get('') && $this->nombre != null) border-success is-valid @endif  @error('nombre') border-danger is-invalid @enderror"
                                        x-on:input="$wire.set('nombre', $('#nombre').val());"
                                        placeholder="Ingrese el nombre" autocomplete="off">
                                    @error('nombre')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('nombre') && $this->nombre != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="s_nombre">Segundo Nombre</label>
                                    <span class="o-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                        title="Campo opcional">?</span>
                                    <input wire:model="s_nombre" type="text" name="s_nombre" id="s_nombre"
                                        class="form-control @if (!$errors->get('') && $this->s_nombre != null) border-success is-valid @endif @error('s_nombre') border-danger is-invalid @enderror"
                                        x-on:input="$wire.set('s_nombre', $('#s_nombre').val());"
                                        placeholder="Ingrese el segundo nombre" autocomplete="off">
                                    @error('s_nombre')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('s_nombre') && $this->s_nombre != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="apellido">Apellido</label>
                                    <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                        title="Campo obligatorio">*</span>
                                    <input wire:model="apellido" type="text" name="apellido" id="apellido"
                                        class="form-control @if (!$errors->get('') && $this->apellido != null) border-success is-valid @endif @error('apellido') border-danger is-invalid @enderror"
                                        x-on:input="$wire.set('apellido', $('#apellido').val());"
                                        placeholder="Ingrese el apellido" autocomplete="off">
                                    @error('apellido')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('apellido') && $this->apellido != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="dni">DNI</label>
                                    <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                        title="Campo obligatorio">*</span>
                                    <input wire:model="dni" type="text" name="dni" id="dni"
                                        class="form-control @if (!$errors->get('') && $this->dni != null) border-success is-valid @endif @error('dni') border-danger is-invalid @enderror"
                                        x-on:input="$wire.set('dni', $('#dni').val());" placeholder="Ingrese el DNI"
                                        autocomplete="off">
                                    @error('dni')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('dni') && $this->dni != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="cuil">CUIL</label>
                                    <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                        title="Campo obligatorio">*</span>
                                    <input wire:model="cuil" type="text" name="cuil" id="cuil"
                                        class="form-control @if (!$errors->get('') && $this->cuil != null) border-success is-valid @endif @error('cuil') border-danger is-invalid @enderror"
                                        x-on:input="$wire.set('cuil', $('#cuil').val());"
                                        placeholder="Ingrese el CUIL" autocomplete="off">
                                    @error('cuil')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('cuil') && $this->cuil != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <input name="fecha_nacimiento" id="fecha_nacimiento"
                                            class="flatpickr form-control" autocomplete="off"
                                            placeholder="Seleccione la fecha de nacimiento">
                                    </div>
                                    @error('fecha_nacimiento')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('fecha_nacimiento') && $this->fecha_nacimiento != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="sexo_selected">Sexo</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <select name="sexo_selected" id="sexo_selected" class="form-control select2"
                                            aria-placeholder="Seleccione una opción">
                                            <option selected value="">Seleccione una opcion</option>
                                            @foreach ($sexos as $sexo)
                                                <option value="{{ $sexo->id }}">{{ $sexo->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('sexo_selected')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('sexo_selected') && $this->sexo_selected != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="estado_civil">Estado Civil</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <select name="estado_civil" id="estado_civil" class="form-control select2"
                                            aria-placeholder="Seleccione una opción">
                                            <option selected value="">Seleccione una opcion</option>
                                            @foreach ($estados_civiles as $estado_c)
                                                <option value="{{ $estado_c->id }}">{{ $estado_c->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('estado_civil')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                        {{-- <script>
                                            window.validarApp\Models\EstadoCivil = () => {
                                                elementos = $('.select2-selection.select2-selection--single.form-control');
                                                for (let i = 0; i < elementos.length; i++) {
                                                    element = elementos[i];
                                                    hijos = $(element).children('span');
                                                    console.log($(hijos[0]).attr('id'));
                                                    if ($(hijos[0]).attr('id') == 'select2-estado_civil-container') {
                                                        $(element).addClass('is-invalid border-danger');
                                                    }
                                                }
                                            }
                                            validarApp\Models\EstadoCivil();
                                        </script> --}}
                                    @enderror
                                    @if (!$errors->get('estado_civil') && $this->estado_civil != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                </div>
                            </div>
                            @if ($fecha_nacimiento != null)
                                @if ($estado_civil != null)
                                    @if (App\Models\EstadoCivil::find($estado_civil)->nombre == 'Soltero/a')
                                        @if (Carbon\Carbon::parse($fecha_nacimiento)->format('Y') >= date('Y') - 18)
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div class="alert alert-warning alert-dismissible">
                                                        <h5><i class="icon fas fa-exclamation-triangle"></i>
                                                            Advertencia!</h5>
                                                        La fecha de nacimiento ingresada indica
                                                        que el
                                                        empleado es menor de edad. Por favor, ingrese el certificado de
                                                        emancipación o permiso de los padres, tutores o encargados.
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    @if (Carbon\Carbon::parse($fecha_nacimiento)->format('Y') >= date('Y') - 18)
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="alert alert-warning alert-dismissible">
                                                    <h5><i class="icon fas fa-exclamation-triangle"></i>
                                                        Advertencia!</h5>
                                                    La fecha de nacimiento ingresada indica
                                                    que el
                                                    empleado es menor de edad. Por favor, ingrese el certificado de
                                                    emancipación o permiso de los padres, tutores o encargados.
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endif
                            <div class="row mb-3">
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="copia_dni">Fotocopia del DNI</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <input type="file" name="copia_dni" hidden id="copia_dni"
                                            accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" class="form-control"
                                            wire:model="copia_dni" placeholder="Ingrese la fotocopia del DNI"
                                            autocomplete="off">
                                    </div>
                                    <a type="button" class="btn btn-primary" x-on:click="$('#copia_dni').click()">
                                        <i class="fas fa-upload"></i>
                                        Subir DNI
                                    </a>
                                    <!-- Vista previa si existe el archivo -->
                                    <div class="border mt-3 d-flex text-center justify-content-center align-items-center"
                                        style=" height: 150px; width: 150px;">
                                        @if (!$copia_dni)
                                            <div class="text-secondary font-italic">
                                                Vista previa no disponible
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="d-flex flex-column align-items-start">
                                                    <div data-toggle="tooltip" data-placement="bottom"
                                                        title="{{ $copia_dni->getClientOriginalName() }}">
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <div class="position-absolute"
                                                                onclick="event.stopPropagation();"
                                                                wire:click="eliminarCopiaDni('{{ $copia_dni->getClientOriginalName() }}')">
                                                                <i class="fas fa-trash eliminar_item"></i>
                                                            </div>
                                                            @if ($copia_dni->guessExtension() == 'pdf')
                                                                <img src="{{ asset('img/pdf.webp') }}" alt=""
                                                                    class="img-fluid" width="100">
                                                            @elseif ($copia_dni->guessExtension() == 'docx' || $copia_dni->guessExtension() == 'doc')
                                                                <img src="{{ asset('img/word.webp') }}"
                                                                    alt="" class="img-fluid" width="100">
                                                            @else
                                                                <img src="{{ $copia_dni->temporaryUrl() }}"
                                                                    alt="" class="img-fluid" width="100">
                                                            @endif
                                                        </div>
                                                        <div class="d-block text-truncate" style="max-width: 100px;">
                                                            {{ $copia_dni->getClientOriginalName() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @if ($this->copia_dni == '')
                                        <span class="d-block text-danger invalid-feedback">Se requiere un
                                            certificado valido</span>
                                    @endif
                                    @if ($this->copia_dni != '')
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    @if ($fecha_nacimiento != null)
                                @if ($estado_civil != null)
                                    @if (App\Models\EstadoCivil::find($estado_civil)->nombre == 'Soltero/a')
                                        @if (Carbon\Carbon::parse($fecha_nacimiento)->format('Y') >= date('Y') - 18)
                                        <div class="col">
                                            <div wire:ignore>
                                                <label for="autorizacion_padres">Certificado Emancipacion o
                                                    Permiso</label>
                                                <span class="d-tooltip parpadea" data-toggle="tooltip"
                                                    data-placement="top" title="Campo obligatorio">*</span>
                                                <input type="file" name="autorizacion_padres" hidden
                                                    accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" id="autorizacion_padres"
                                                    class="form-control" wire:model="autorizacion_padres"
                                                    placeholder="Ingrese el certificado de emancipacion o permiso de tutores"
                                                    autocomplete="off">
                                            </div>
                                            <a type="button" class="btn btn-primary"
                                                x-on:click="$('#autorizacion_padres').click()">
                                                <i class="fas fa-upload"></i>
                                                Subir Archivo
                                            </a>
                                            <!-- Vista previa si existe el archivo -->
                                            <div class="border mt-3 d-flex text-center justify-content-center align-items-center"
                                                style=" height: 150px; width: 150px;">
                                                @if (!$autorizacion_padres)
                                                    <div class="text-secondary font-italic">
                                                        Vista previa no disponible
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <div class="d-flex flex-column align-items-start">
                                                            <div data-toggle="tooltip" data-placement="bottom"
                                                                title="{{ $autorizacion_padres->getClientOriginalName() }}">
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <div class="position-absolute"
                                                                        onclick="event.stopPropagation();"
                                                                        wire:click="eliminarAutorizacionPadres('{{ $autorizacion_padres->getClientOriginalName() }}')">
                                                                        <i class="fas fa-trash eliminar_item"></i>
                                                                    </div>
                                                                    @if ($autorizacion_padres->guessExtension() == 'pdf')
                                                                        <img src="{{ asset('img/pdf.webp') }}"
                                                                            alt="" class="img-fluid"
                                                                            width="100">
                                                                    @elseif ($autorizacion_padres->guessExtension() == 'docx' || $autorizacion_padres->guessExtension() == 'doc')
                                                                        <img src="{{ asset('img/word.webp') }}"
                                                                            alt="" class="img-fluid"
                                                                            width="100">
                                                                    @else
                                                                        <img src="{{ $autorizacion_padres->temporaryUrl() }}"
                                                                            alt="" class="img-fluid"
                                                                            width="100">
                                                                    @endif
                                                                </div>
                                                                <div class="d-block text-truncate"
                                                                    style="max-width: 100px;">
                                                                    {{ $autorizacion_padres->getClientOriginalName() }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            @if ($this->autorizacion_padres == '')
                                                <span class="d-block text-danger invalid-feedback">Se requiere
                                                    un
                                                    certificado valido</span>
                                            @endif
                                            @if ($this->autorizacion_padres != '')
                                                <span class="d-block text-success valid-feedback">Campo
                                                    correcto</span>
                                            @endif
                                        </div>
                                        @endif
                                    @endif
                                @else
                                    @if (Carbon\Carbon::parse($fecha_nacimiento)->format('Y') >= date('Y') - 18)
                                        <div class="col">
                                            <div wire:ignore>
                                                <label for="autorizacion_padres">Certificado Emancipacion o
                                                    Permiso</label>
                                                <span class="d-tooltip parpadea" data-toggle="tooltip"
                                                    data-placement="top" title="Campo obligatorio">*</span>
                                                <input type="file" name="autorizacion_padres" hidden
                                                    accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" id="autorizacion_padres"
                                                    class="form-control" wire:model="autorizacion_padres"
                                                    placeholder="Ingrese el certificado de emancipacion o permiso de tutores"
                                                    autocomplete="off">
                                            </div>
                                            <a type="button" class="btn btn-primary"
                                                x-on:click="$('#autorizacion_padres').click()">
                                                <i class="fas fa-upload"></i>
                                                Subir Archivo
                                            </a>
                                            <!-- Vista previa si existe el archivo -->
                                            <div class="border mt-3 d-flex text-center justify-content-center align-items-center"
                                                style=" height: 150px; width: 150px;">
                                                @if (!$autorizacion_padres)
                                                    <div class="text-secondary font-italic">
                                                        Vista previa no disponible
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <div class="d-flex flex-column align-items-start">
                                                            <div data-toggle="tooltip" data-placement="bottom"
                                                                title="{{ $autorizacion_padres->getClientOriginalName() }}">
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center">
                                                                    <div class="position-absolute"
                                                                        onclick="event.stopPropagation();"
                                                                        wire:click="eliminarAutorizacionPadres('{{ $autorizacion_padres->getClientOriginalName() }}')">
                                                                        <i class="fas fa-trash eliminar_item"></i>
                                                                    </div>
                                                                    @if ($autorizacion_padres->guessExtension() == 'pdf')
                                                                        <img src="{{ asset('img/pdf.webp') }}"
                                                                            alt="" class="img-fluid"
                                                                            width="100">
                                                                    @elseif ($autorizacion_padres->guessExtension() == 'docx' || $autorizacion_padres->guessExtension() == 'doc')
                                                                        <img src="{{ asset('img/word.webp') }}"
                                                                            alt="" class="img-fluid"
                                                                            width="100">
                                                                    @else
                                                                        <img src="{{ $autorizacion_padres->temporaryUrl() }}"
                                                                            alt="" class="img-fluid"
                                                                            width="100">
                                                                    @endif
                                                                </div>
                                                                <div class="d-block text-truncate"
                                                                    style="max-width: 100px;">
                                                                    {{ $autorizacion_padres->getClientOriginalName() }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            @if ($this->autorizacion_padres == '')
                                                <span class="d-block text-danger invalid-feedback">Se requiere
                                                    un
                                                    certificado valido</span>
                                            @endif
                                            @if ($this->autorizacion_padres != '')
                                                <span class="d-block text-success valid-feedback">Campo
                                                    correcto</span>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            @endif 
                                </div>
                                <div class="col">

                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- DOMICILIO -->

                    <div class="card card-primary">
                        <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                            <h3 class="card-title">Domicilio</h3>
                            <div class="card-tools">
                                <a type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                                </a>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="pais_selected">País</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <select type="text" name="pais_selected" id="pais_selected"
                                            class="form-control @if (!$errors->get('') && $this->pais_selected != null) border-success is-valid @endif @error('pais_selected') border-danger is-invalid @enderror"
                                            placeholder="Seleccione el país" autocomplete="off">
                                            <option selected value="">Seleccione una opcion</option>
                                            @foreach ($paises as $pais)
                                                <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('pais_selected')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('pais_selected') && $this->pais_selected != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="provincia_selected">Provincia</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <select type="text" name="provincia_selected" id="provincia_selected"
                                            class="form-control @if (!$errors->get('') && $this->provincia_selected != null) border-success is-valid @endif @error('provincia_selected') border-danger is-invalid @enderror"
                                            placeholder="Seleccione la provincia" autocomplete="off">
                                            <option selected value="">Seleccione una opcion</option>
                                        </select>
                                    </div>
                                    @error('provincia_selected')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('provincia_selected') && $this->provincia_selected != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="municipio_selected">Municipio</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <select type="text" name="municipio_selected" id="municipio_selected"
                                            class="form-control @if (!$errors->get('') && $this->municipio_selected != null) border-success is-valid @endif @error('municipio_selected') border-danger is-invalid @enderror"
                                            placeholder="Seleccione el municipio" autocomplete="off">
                                            <option selected value="">Seleccione una opcion</option>
                                        </select>
                                    </div>
                                    @error('municipio_selected')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('municipio_selected') && $this->municipio_selected != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <div>
                                        <label for="calle">Calle</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <input type="text" name="calle" id="calle"
                                            class="form-control @if (!$errors->get('') && $this->calle != null) border-success is-valid @endif @error('calle') border-danger is-invalid @enderror"
                                            placeholder="Ingrese el nombre de la calle" autocomplete="off"
                                            x-on:input="$wire.set('calle', $('#calle').val());">
                                    </div>
                                    @error('calle')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('calle') && $this->calle != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <div>
                                        <label for="altura">Altura</label>
                                        <span class="do-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo opcional">?</span>
                                        <input type="number" name="altura" id="altura"
                                            class="form-control @if (!$errors->get('') && $this->altura != null) border-success is-valid @endif @error('altura') border-danger is-invalid @enderror"
                                            placeholder="Ingrese la altura" autocomplete="off"
                                            x-on:input="$wire.set('altura', $('#altura').val());">
                                    </div>
                                    @error('altura')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('altura') && $this->altura != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <div>
                                        <label for="departamento">Departamento</label>
                                        <span class="do-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo opcional">?</span>
                                        <input type="text" name="departamento" id="departamento"
                                            class="form-control @if (!$errors->get('') && $this->departamento != null) border-success is-valid @endif @error('departamento') border-danger is-invalid @enderror"
                                            placeholder="Ingrese el departamento" autocomplete="off"
                                            x-on:input="$wire.set('departamento', $('#departamento').val());">
                                    </div>
                                    @error('departamento')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('departamento') && $this->departamento != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="certificado_domicilio">Certificado de Domicilio</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <input type="file" name="certificado_domicilio" hidden
                                            accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" id="certificado_domicilio"
                                            class="form-control" wire:model="certificado_domicilio"
                                            placeholder="Ingrese el certificado de domicilio" autocomplete="off">
                                    </div>
                                    <a type="button" class="btn btn-primary"
                                        x-on:click="$('#certificado_domicilio').click()">
                                        <i class="fas fa-upload"></i>
                                        Subir Archivo
                                    </a>
                                    <!-- Vista previa si existe el archivo -->
                                    <div class="border mt-3 d-flex text-center justify-content-center align-items-center"
                                        style=" height: 150px; width: 150px;">
                                        @if (!$certificado_domicilio)
                                            <div class="text-secondary font-italic">
                                                Vista previa no disponible
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="d-flex flex-column align-items-start">
                                                    <div data-toggle="tooltip" data-placement="bottom"
                                                        title="{{ $certificado_domicilio->getClientOriginalName() }}">
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <div class="position-absolute"
                                                                onclick="event.stopPropagation();"
                                                                wire:click="eliminarCertificadoDomicilio('{{ $certificado_domicilio->getClientOriginalName() }}')">
                                                                <i class="fas fa-trash eliminar_item"></i>
                                                            </div>
                                                            @if ($certificado_domicilio->guessExtension() == 'pdf')
                                                                <img src="{{ asset('img/pdf.webp') }}" alt=""
                                                                    class="img-fluid" width="100">
                                                            @elseif ($certificado_domicilio->guessExtension() == 'docx' || $autorizacion_padres->guessExtension() == 'doc')
                                                                <img src="{{ asset('img/word.webp') }}"
                                                                    alt="" class="img-fluid" width="100">
                                                            @else
                                                                <img src="{{ $certificado_domicilio->temporaryUrl() }}"
                                                                    alt="" class="img-fluid" width="100">
                                                            @endif
                                                        </div>
                                                        <div class="d-block text-truncate" style="max-width: 100px;">
                                                            {{ $certificado_domicilio->getClientOriginalName() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @if ($this->certificado_domicilio == '')
                                        <span class="d-block text-danger invalid-feedback">Se requiere un
                                            certificado valido</span>
                                    @endif
                                    @if ($this->certificado_domicilio != '')
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- FAMILIARES A CARGO -->

                    <div class="card card-primary">
                        <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                            <h3 class="card-title">Familiares a Cargo</h3>
                            <div class="card-tools">
                                <a type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                                </a>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col mb-3">
                                <p class="text-bold text-danger">
                                    El contratado @if ($nombre && $s_nombre && $apellido && $cuil)
                                        de nombre {{ $nombre . ' ' . $s_nombre . ' ' . $apellido }} cuyo CUIL es
                                        {{ $cuil }},
                                    @endif afirma poseer familiares a su cargo, ya
                                    sea cónyuge, hijos u otros dependientes
                                    económicos, y se compromete a informar cualquier cambio que modifique el
                                    contenido de esta declaración.
                                </p>
                                <div class="icheck-primary icheck-inline">
                                    <input type="checkbox" id="chb" name="chb"
                                        wire:model="tiene_familiares"
                                        x-on:click="$wire.set('tiene_familiares', $('#chb').is(':checked'));">
                                    <label for="chb">Declarar familiares</label>
                                </div>
                            </div>
                            @if ($tiene_familiares == false)
                                <!-- No presenta familiares a cargo -->
                                <div class="row mb-3 justify-content-center font-italic text-sm">
                                    <p>Actualmente no se registran familiares a cargo. Para agregar familiares debe
                                        declarar que posee familiares a su cargo.</p>
                                </div>
                            @else
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="nombre_familiar">Nombre del Familiar</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <input wire:model="nombre_familiar" type="text" name="nombre_familiar"
                                            id="nombre_familiar"
                                            class="form-control @if (!$errors->get('') && $this->nombre_familiar != null) border-success is-valid @endif  @error('nombre_familiar') border-danger is-invalid @enderror"
                                            x-on:input="$wire.set('nombre_familiar', $('#nombre_familiar').val());"
                                            placeholder="Ingrese el nombre del familiar" autocomplete="off">
                                        @error('nombre_familiar')
                                            <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        @if (!$errors->get('nombre_familiar') && $this->nombre_familiar != null)
                                            <span class="d-block text-success valid-feedback">Campo correcto</span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <label for="apellido_familiar">Apellido del Familiar</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <input wire:model="apellido_familiar" type="text" name="apellido_familiar"
                                            id="apellido_familiar"
                                            class="form-control @if (!$errors->get('') && $this->apellido_familiar != null) border-success is-valid @endif @error('apellido_familiar') border-danger is-invalid @enderror"
                                            x-on:input="$wire.set('apellido_familiar', $('#apellido_familiar').val());"
                                            placeholder="Ingrese el apellido del familiar" autocomplete="off">
                                        @error('apellido_familiar')
                                            <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        @if (!$errors->get('apellido_familiar') && $this->apellido_familiar != null)
                                            <span class="d-block text-success valid-feedback">Campo correcto</span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <div wire:ignore>
                                            <label for="sexo_selected_familiar">Sexo del Familiar</label>
                                            <span class="d-tooltip parpadea" data-toggle="tooltip"
                                                data-placement="top" title="Campo obligatorio">*</span>
                                            <select name="sexo_selected_familiar" id="sexo_selected_familiar"
                                                class="form-control select2" aria-placeholder="Seleccione una opción">
                                                <option selected value="">Seleccione una opcion</option>
                                                @foreach ($sexos as $sexo)
                                                    <option value="{{ $sexo->id }}">{{ $sexo->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('sexo_selected_familiar')
                                            <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        @if (!$errors->get('sexo_selected_familiar') && $this->sexo_selected_familiar != null)
                                            <span class="d-block text-success valid-feedback">Campo correcto</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="dni_familiar">DNI del Familiar</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <input wire:model="dni_familiar" type="text" name="dni_familiar"
                                            id="dni_familiar"
                                            class="form-control @if (!$errors->get('') && $this->dni_familiar != null) border-success is-valid @endif @error('dni_familiar') border-danger is-invalid @enderror"
                                            x-on:input="$wire.set('dni_familiar', $('#dni_familiar').val());"
                                            placeholder="Ingrese el DNI" autocomplete="off">
                                        @error('dni_familiar')
                                            <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        @if (!$errors->get('dni_familiar') && $this->dni_familiar != null)
                                            <span class="d-block text-success valid-feedback">Campo correcto</span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <div wire:ignore>
                                            <label for="fecha_nacimiento_familiar">Fecha de Nacimiento del
                                                Familiar</label>
                                            <span class="d-tooltip parpadea" data-toggle="tooltip"
                                                data-placement="top" title="Campo obligatorio">*</span>
                                            <input name="fecha_nacimiento_familiar" id="fecha_nacimiento_familiar"
                                                class="flatpickr form-control" autocomplete="off"
                                                placeholder="Seleccione la fecha de nacimiento">
                                        </div>
                                        @error('fecha_nacimiento_familiar')
                                            <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        @if (!$errors->get('fecha_nacimiento_familiar') && $this->fecha_nacimiento_familiar != null)
                                            <span class="d-block text-success valid-feedback">Campo correcto</span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <div wire:ignore>
                                            <label for="tipo_relacion_familiar_selected">Tipo de Relación</label>
                                            <span class="d-tooltip parpadea" data-toggle="tooltip"
                                                data-placement="top" title="Campo obligatorio">*</span>
                                            <select name="tipo_relacion_familiar_selected"
                                                id="tipo_relacion_familiar_selected" class="form-control select2"
                                                aria-placeholder="Seleccione una opción">
                                                <option selected value="">Seleccione una opcion</option>
                                                @foreach ($relaciones_familiares as $relacion_familiar)
                                                    <option value="{{ $relacion_familiar->id }}">
                                                        {{ $relacion_familiar->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('tipo_relacion_familiar_selected')
                                            <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        @if (!$errors->get('tipo_relacion_familiar_selected') && $this->tipo_relacion_familiar_selected != null)
                                            <span class="d-block text-success valid-feedback">Campo correcto</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <div wire:ignore>
                                            <label for="certificado_familiar.*">Certificado de familiar a cargo</label>
                                            <span class="d-tooltip parpadea" data-toggle="tooltip"
                                                data-placement="top" title="Campo obligatorio">*</span>
                                            <input type="file" name="certificado_familiar" hidden
                                                accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" id="certificado_familiar"
                                                class="form-control" wire:model="certificado_familiar"
                                                placeholder="Ingrese el certificado de discapacidad"
                                                autocomplete="off">
                                        </div>
                                        <a type="button" class="btn btn-primary"
                                            x-on:click="$('#certificado_familiar').click()">
                                            <i class="fas fa-upload"></i>
                                            Subir Archivo
                                        </a>
                                        <!-- Vista previa si existe el archivo -->
                                        <div class="border mt-3 d-flex text-center justify-content-center align-items-center"
                                            style=" height: 150px; width: 150px;">
                                            @if (!$certificado_familiar)

                                                <div class="text-secondary font-italic">
                                                    Vista previa no disponible
                                                </div>
                                            @else
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <div class="d-flex flex-column align-items-start">
                                                        <div data-toggle="tooltip" data-placement="bottom"
                                                            title="{{ $certificado_familiar->getClientOriginalName() }}">
                                                            <div
                                                                class="d-flex justify-content-center align-items-center">
                                                                <div class="position-absolute"
                                                                    onclick="event.stopPropagation();"
                                                                    wire:click="eliminarCertificadoFamiliar('{{ $certificado_familiar->getClientOriginalName() }}')">
                                                                    <i class="fas fa-trash eliminar_item"></i>
                                                                </div>
                                                                @if ($certificado_familiar->guessExtension() == 'pdf')
                                                                    <img src="{{ asset('img/pdf.webp') }}"
                                                                        alt="" class="img-fluid"
                                                                        width="100">
                                                                @elseif ($certificado_familiar->guessExtension() == 'docx' || $certificado_familiar->guessExtension() == 'doc')
                                                                    <img src="{{ asset('img/word.webp') }}"
                                                                        alt="" class="img-fluid"
                                                                        width="100">
                                                                @else
                                                                    <img src="{{ $certificado_familiar->temporaryUrl() }}"
                                                                        alt="" class="img-fluid"
                                                                        width="100">
                                                                @endif
                                                            </div>
                                                            <div class="d-block text-truncate"
                                                                style="max-width: 100px;">
                                                                {{ $certificado_familiar->getClientOriginalName() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        @if ($this->certificado_familiar == '')
                                            <span class="d-block text-danger invalid-feedback">Se requiere un
                                                certificado valido</span>
                                        @endif
                                        @if ($this->certificado_familiar != '' && $tiene_familiares)
                                            <span class="d-block text-success valid-feedback">Campo correcto</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <a class="btn btn-primary" x-on:click="$wire.agregarFamiliar()">
                                            <i class="fas fa-user"></i>
                                            Cargar Datos del Familiar
                                        </a>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <!-- Listado de familiares -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>DNI</th>
                                                    <th>Fecha de Nacimiento</th>
                                                    <th>Sexo</th>
                                                    <th>Tipo de Relación</th>
                                                    <th>Certificado</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($familiares_cargo as $familiar)
                                                    <tr>
                                                        <td>{{ $familiar['nombre'] }}</td>
                                                        <td>{{ $familiar['apellido'] }}</td>
                                                        <td>{{ $familiar['dni'] }}</td>
                                                        <td>{{ $familiar['fecha_nacimiento'] }}</td>
                                                        <td>{{ $familiar['sexo'] }}</td>
                                                        <td>{{ $familiar['tipo_relacion'] }}</td>
                                                        <td>
                                                            @if ($familiar['certificado'])
                                                                <div style="cursor: pointer;">
                                                                    <div class="d-block text-truncate"
                                                                        style="max-width: 120px;"
                                                                        data-toggle="tooltip" data-placement="bottom"
                                                                        title="{{ $familiar['certificado']->getClientOriginalName() }}">
                                                                        <i class="fas fa-file-pdf"></i>
                                                                        <span>{{ $familiar['certificado']->getClientOriginalName() }}</span>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        <td>
                                                            <a class="btn btn-danger"
                                                                onclick="eliminar_familiar('{{ $familiar['dni'] }}')">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <a class="btn btn-primary"
                                                                onclick="editar_familiar('{{ $familiar['dni'] }}')">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @if ($errors->get('familiares_cargo'))
                                    <div class="row mb-3">
                                        <div class="col">
                                            <span
                                                class="d-block text-danger invalid-feedback">{{ $errors->get('familiares_cargo')[0] }}</span>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- OBRA SOCIAL -->

                    <div class="card card-primary">
                        <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                            <h3 class="card-title">Obra Social</h3>
                            <div class="card-tools">
                                <a type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                                </a>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col mb-3">
                                <p class="text-bold text-danger">
                                    El contratado @if ($nombre && $s_nombre && $apellido && $cuil)
                                        de nombre {{ $nombre . ' ' . $s_nombre . ' ' . $apellido }} cuyo CUIL es
                                        {{ $cuil }},
                                    @endif afirma poseer una obra social.
                                </p>
                                <div class="icheck-primary icheck-inline">
                                    <input type="checkbox" id="chb2" name="chb2"
                                        wire:model="tiene_obra_social"
                                        x-on:click="$wire.set('tiene_obra_social', $('#chb2').is(':checked'));">
                                    <label for="chb2">Afirmo ser afiliado a una obra social</label>
                                </div>
                            </div>
                            @if ($tiene_obra_social == false)
                                <!-- No presenta familiares a cargo -->
                                <div class="row mb-3 justify-content-center font-italic text-sm">
                                    <p>Actualmente no se registra una obra social. Para agregar una obra social debe
                                        declarar que posee una.</p>
                                </div>
                            @else
                                <div class="row mb-3">
                                    <div class="col">
                                        <div wire:ignore>
                                            <label for="obra_social_selected">Obra Social</label>
                                            <span class="d-tooltip parpadea" data-toggle="tooltip"
                                                data-placement="top" title="Campo obligatorio">*</span>
                                            <select name="obra_social_selected" id="obra_social_selected"
                                                class="form-control select2" aria-placeholder="Seleccione una opción">
                                                <option selected value="">Seleccione una opcion</option>
                                                @foreach ($obras_sociales as $obra_social)
                                                    <option value="{{ $obra_social->id }}">{{ $obra_social->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('obra_social_selected')
                                            <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        @if (!$errors->get('obra_social_selected') && $this->obra_social_selected != null)
                                            <span class="d-block text-success valid-feedback">Campo correcto</span>
                                        @endif
                                    </div>

                                    <div class="col">
                                        <label for="numero_afiliado">Numero de Afiliado</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <input wire:model="numero_afiliado" type="text" name="numero_afiliado"
                                            id="numero_afiliado"
                                            class="form-control @if (!$errors->get('') && $this->numero_afiliado != null) border-success is-valid @endif  @error('numero_afiliado') border-danger is-invalid @enderror"
                                            x-on:input="$wire.set('numero_afiliado', $('#numero_afiliado').val());"
                                            placeholder="Ingrese el numero de afiliado" autocomplete="off">
                                        @error('numero_afiliado')
                                            <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        @if (!$errors->get('numero_afiliado') && $this->numero_afiliado != null)
                                            <span class="d-block text-success valid-feedback">Campo correcto</span>
                                        @endif
                                    </div>
                                    <div class="col"> </div>
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>


                    <!-- CONTACTO Y CONTACTOS DE EMERGENCIA -->

                    <div class="card card-primary">
                        <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                            <h3 class="card-title">Información y Contactos de Emergencia</h3>
                            <div class="card-tools">
                                <a type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                                </a>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p>Informacion de contacto personal:</p>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="email">Email de uso Personal</label>
                                    <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                        title="Campo obligatorio">*</span>
                                    <input wire:model="email" type="text" name="email" id="email"
                                        class="form-control @if (!$errors->get('') && $this->email != null) border-success is-valid @endif @error('email') border-danger is-invalid @enderror"
                                        x-on:input="$wire.set('email', $('#email').val());"
                                        placeholder="Ingrese el email" autocomplete="off">
                                    @error('email')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('email') && $this->email != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>

                                <div class="col"></div>
                                <div class="col"></div>

                            </div>
                            <p>Informacion de contactos de emergencia:</p>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="nombre_emergencia">Nombre del Contacto</label>
                                    <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                        title="Campo obligatorio">*</span>
                                    <input wire:model="nombre_emergencia" type="text" name="nombre_emergencia"
                                        id="nombre_emergencia"
                                        class="form-control @if (!$errors->get('') && $this->nombre_emergencia != null) border-success is-valid @endif  @error('nombre_emergencia') border-danger is-invalid @enderror"
                                        x-on:input="$wire.set('nombre_emergencia', $('#nombre_emergencia').val());"
                                        placeholder="Ingrese el nombre" autocomplete="off">
                                    @error('nombre_emergencia')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('nombre_emergencia') && $this->nombre_emergencia != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="apellido_emergencia">Apellido del Contacto</label>
                                    <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                        title="Campo obligatorio">*</span>
                                    <input wire:model="apellido_emergencia" type="text" name="apellido_emergencia"
                                        id="apellido_emergencia"
                                        class="form-control @if (!$errors->get('') && $this->apellido_emergencia != null) border-success is-valid @endif  @error('apellido_emergencia') border-danger is-invalid @enderror"
                                        x-on:input="$wire.set('apellido_emergencia', $('#apellido_emergencia').val());"
                                        placeholder="Ingrese el nombre" autocomplete="off">
                                    @error('apellido_emergencia')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('apellido_emergencia') && $this->apellido_emergencia != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>

                                <div class="col">
                                    <div wire:ignore>
                                        <label for="tipo_relacion_familiar_selected_dos">Tipo de Relación</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <select name="tipo_relacion_familiar_selected_dos"
                                            id="tipo_relacion_familiar_selected_dos" class="form-control select2"
                                            aria-placeholder="Seleccione una opción">
                                            <option selected value="">Seleccione una opcion</option>
                                            @foreach ($relaciones_familiares_dos as $relacion_familiar)
                                                <option value="{{ $relacion_familiar->id }}">
                                                    {{ $relacion_familiar->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('tipo_relacion_familiar_selected_dos')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('tipo_relacion_familiar_selected_dos') && $this->tipo_relacion_familiar_selected_dos != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="telefono_emergencia">Telefono de Emergencia</label>
                                    <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                        title="Campo obligatorio">*</span>
                                    <input wire:model="telefono_emergencia" type="text" name="telefono_emergencia"
                                        id="telefono_emergencia"
                                        class="form-control @if (!$errors->get('') && $this->telefono_emergencia != null) border-success is-valid @endif  @error('telefono_emergencia') border-danger is-invalid @enderror"
                                        x-on:input="$wire.set('telefono_emergencia', $('#telefono_emergencia').val());"
                                        placeholder="Ingrese el numero de telefono" autocomplete="off">
                                    @error('telefono_emergencia')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('telefono_emergencia') && $this->telefono_emergencia != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="email_emergencia">Email de Emergencia</label>
                                    <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                        title="Campo obligatorio">*</span>
                                    <input wire:model="email_emergencia" type="text" name="email_emergencia"
                                        id="email_emergencia"
                                        class="form-control @if (!$errors->get('') && $this->email_emergencia != null) border-success is-valid @endif  @error('email_emergencia') border-danger is-invalid @enderror"
                                        x-on:input="$wire.set('email_emergencia', $('#email_emergencia').val());"
                                        placeholder="Ingrese el email" autocomplete="off">
                                    @error('email_emergencia')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('email_emergencia') && $this->email_emergencia != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col"></div>

                            </div>
                            <div class="row mb-3">
                                <!-- Btn agregar contacto de emergencia -->
                                <div class="col">
                                    <a class="btn btn-primary" x-on:click="$wire.agregarContactoEmergencia()">
                                        <i class="fas fa-user"></i>
                                        Cargar Datos del Contacto
                                    </a>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Listado de contactos de emergencia -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Telefono</th>
                                                <th>Email</th>
                                                <th>Tipo de Relación</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contactos_emergencia as $contacto)
                                                <tr>
                                                    <td>{{ $contacto['nombre'] }}</td>
                                                    <td>{{ $contacto['apellido'] }}</td>
                                                    <td>{{ $contacto['telefono'] }}</td>
                                                    <td>{{ $contacto['email'] }}</td>
                                                    <td>{{ $contacto['tipo_relacion'] }}</td>
                                                    <td>
                                                        <a class="btn btn-danger"
                                                            onclick="eliminar_contacto('{{ $contacto['telefono'] }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        <a class="btn btn-primary"
                                                            onclick="editar_contacto('{{ $contacto['telefono'] }}')">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <a class="btn btn-primary" x-on:click="$wire.previousStep()">←</a>
                        <a class="btn btn-primary" x-on:click="$wire.nextStep()">→</a>
                    </div>
                </div>

            </div>


            <!-- SEGUNDO STEP -->
            <div wire:ignore.self class="bs-stepper-content">
                <div wire:ignore.self id="datos-legajo" class="content" role="tabpanel"
                    aria-labelledby="datos-legajo-trigger">

                    <div class="card card-primary">
                        <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                            <h3 class="card-title">Datos del Puesto de Trabajo</h3>
                            <div class="card-tools">
                                <a type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                                </a>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="puesto_de_trabajo_selected">Puesto de Trabajo Afectado</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <select name="puesto_de_trabajo_selected" id="puesto_de_trabajo_selected"
                                            class="form-control select2" aria-placeholder="Seleccione una opción">
                                            <option selected value="">Seleccione una opcion</option>
                                            @foreach ($puestos_de_trabajo as $puesto_de_trabajo)
                                                <option value="{{ $puesto_de_trabajo->id }}">
                                                    {{ $puesto_de_trabajo->titulo_puesto }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('puesto_de_trabajo_selected')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('puesto_de_trabajo_selected') && $this->puesto_de_trabajo_selected != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="sueldo">Sueldo Basico</label>
                                    <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                        title="Campo obligatorio">*</span>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">$</span>
                                        </div>
                                        <input wire:model="sueldo" type="number" name="sueldo" id="sueldo"
                                            aria-describedby="basic-addon1" step=".01"
                                            class="form-control 
                                    @if (!$errors->get('') && $this->sueldo != null) border-success is-valid @endif  
                                    @error('sueldo') border-danger is-invalid @enderror"
                                            x-on:input="$wire.set('sueldo', $('#sueldo').val());" placeholder="0.00"
                                            autocomplete="off">
                                        
                                    </div>
                                    <p class="text-muted text-sm">{{ $puesto_de_trabajo_selected ? 'El sueldo base de referencia para el puesto seleccionado es de $' . App\Models\PuestoTrabajo::find($puesto_de_trabajo_selected)->sueldo_base . ' ARS' : 'Seleccione un puesto de trabajo para obtener un valor de referencia' }}</p>
                                    @error('sueldo')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('sueldo') && $this->sueldo != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="fecha_ingreso">Fecha de Ingreso</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <input name="fecha_ingreso" id="fecha_ingreso" class="flatpickr form-control"
                                            placeholder="Seleccione la fecha de ingreso" autocomplete="off">
                                    </div>
                                    @error('fecha_ingreso')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('fecha_ingreso') && $this->fecha_ingreso != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <input name="fecha_vencimiento" id="fecha_vencimiento"
                                            class="flatpickr form-control" autocomplete="off"
                                            placeholder="Seleccione la fecha de vencimiento">
                                    </div>
                                    @error('fecha_vencimiento')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('fecha_vencimiento') && $this->fecha_vencimiento != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="tipo_contratos_selected">Tipo de Contrato</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <select name="tipo_contratos_selected" id="tipo_contratos_selected"
                                            class="form-control select2" aria-placeholder="Seleccione una opción">
                                            <option selected value="">Seleccione una opcion</option>
                                            @foreach ($tipo_contratos as $tipo_contrato)
                                                <option value="{{ $tipo_contrato->id }}">
                                                    {{ $tipo_contrato->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($tipo_contratos as $tipo_contrato)    
                                            <p id="ayuda_contrato_{{$tipo_contrato->id}}" class="text-muted text-sm ayuda_contrato" hidden>{{$tipo_contrato->descripcion}}</p>
                                        @endforeach
                                    </div>
                                    @error('tipo_contratos_selected')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('tipo_contratos_selected') && $this->tipo_contratos_selected != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="tipo_jornadas_selected">Tipo de Jornada</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <select name="tipo_jornadas_selected" id="tipo_jornadas_selected"
                                            class="form-control select2" aria-placeholder="Seleccione una opción">
                                            <option selected value="">Seleccione una opcion</option>
                                            @foreach ($tipo_jornadas as $tipo_jornada)
                                                <option value="{{ $tipo_jornada->id }}">
                                                    {{ $tipo_jornada->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($tipo_jornadas as $tipo_jornada)    
                                            <p id="ayuda_jornada_{{$tipo_jornada->id}}" class="text-muted text-sm ayuda_jornada" hidden>{{$tipo_jornada->descripcion}}</p>
                                        @endforeach
                                    </div>
                                    @error('tipo_jornadas_selected')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('tipo_jornadas_selected') && $this->tipo_jornadas_selected != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="hora_entrada">Hora de Entrada</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <input name="hora_entrada" id="hora_entrada" class="flatpickr form-control" autocomplete="off"
                                            placeholder="Seleccione la hora de entrada">
                                    </div>
                                    @error('hora_entrada')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('hora_entrada') && $this->hora_entrada != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="hora_inicio_receso">Inicio de Receso</label>
                                        <span class="o-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo opcional">?</span>
                                        <input name="hora_inicio_receso" id="hora_inicio_receso" class="flatpickr form-control" autocomplete="off"
                                            placeholder="Seleccione la hora de entrada">
                                    </div>
                                    @error('hora_inicio_receso')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('hora_inicio_receso') && $this->hora_inicio_receso != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="hora_fin_receso">Fin de Receso</label>
                                        <span class="o-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo opcional">?</span>
                                        <input name="hora_fin_receso" id="hora_fin_receso" class="flatpickr form-control" autocomplete="off"
                                            placeholder="Seleccione la hora de entrada">
                                    </div>
                                    @error('hora_fin_receso')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('hora_fin_receso') && $this->hora_fin_receso != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                                <div class="col">
                                    <div wire:ignore>
                                        <label for="hora_salida">Hora de Salida</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <input name="hora_salida" id="hora_salida" class="flatpickr form-control" autocomplete="off"
                                            placeholder="Seleccione la hora de entrada">
                                    </div>
                                    @error('hora_salida')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('hora_salida') && $this->hora_salida != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="row mb-3">
                                    <div class="col">
                                        <div wire:ignore>
                                            <label for="contrato_trabajo.*">Contrato de Trabajo</label>
                                            <span class="d-tooltip parpadea" data-toggle="tooltip"
                                                data-placement="top" title="Campo obligatorio">*</span>
                                            <input type="file" name="contrato_trabajo" hidden
                                                accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" id="contrato_trabajo"
                                                class="form-control" wire:model="contrato_trabajo"
                                                placeholder="Ingrese el contrato de trabajo" autocomplete="off">
                                        </div>
                                        <a type="button" class="btn btn-primary"
                                            x-on:click="$('#contrato_trabajo').click()">
                                            <i class="fas fa-upload"></i>
                                            Subir Archivo
                                        </a>
                                        <!-- Vista previa si existe el archivo -->
                                        <div class="border mt-3 d-flex text-center justify-content-center align-items-center"
                                            style=" height: 150px; width: 150px;">
                                            @if (!$contrato_trabajo)

                                                <div class="text-secondary font-italic">
                                                    Vista previa no disponible
                                                </div>
                                            @else
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <div class="d-flex flex-column align-items-start">
                                                        <div data-toggle="tooltip" data-placement="bottom"
                                                            title="{{ $contrato_trabajo->getClientOriginalName() }}">
                                                            <div
                                                                class="d-flex justify-content-center align-items-center">
                                                                <div class="position-absolute"
                                                                    onclick="event.stopPropagation();"
                                                                    wire:click="eliminarContratoTrabajo('{{ $contrato_trabajo->getClientOriginalName() }}')">
                                                                    <i class="fas fa-trash eliminar_item"></i>
                                                                </div>
                                                                @if ($contrato_trabajo->guessExtension() == 'pdf')
                                                                    <img src="{{ asset('img/pdf.webp') }}"
                                                                        alt="" class="img-fluid"
                                                                        width="100">
                                                                @elseif ($contrato_trabajo->guessExtension() == 'docx' || $contrato_trabajo->guessExtension() == 'doc')
                                                                    <img src="{{ asset('img/word.webp') }}"
                                                                        alt="" class="img-fluid"
                                                                        width="100">
                                                                @else
                                                                    <img src="{{ $contrato_trabajo->temporaryUrl() }}"
                                                                        alt="" class="img-fluid"
                                                                        width="100">
                                                                @endif
                                                            </div>
                                                            <div class="d-block text-truncate"
                                                                style="max-width: 100px;">
                                                                {{ $contrato_trabajo->getClientOriginalName() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        @if ($this->contrato_trabajo == '')
                                            <span class="d-block text-danger invalid-feedback">Se requiere un
                                                contrato valido</span>
                                        @endif
                                        @if ($this->contrato_trabajo != '')
                                            <span class="d-block text-success valid-feedback">Campo correcto</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col"></div>
                                <div class="col"></div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card card-primary">
                        <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                            <h3 class="card-title">Competencias Satisfactorias del Empleado</h3>
                            <div class="card-tools">
                                <a type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                                </a>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($puesto_de_trabajo_selected != null)
                                <p>Competencias que el empleado ofrece para cubrir el puesto de trabajo seleccionado:
                                </p>
                                @foreach ($competencias as $competencia)
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="icheck-primary icheck-inline">
                                                <input type="checkbox" id="cchb{{ $competencia->id }}"
                                                    name="cchb{{ $competencia->id }}"
                                                    value="{{ $competencia->id }}"
                                                    x-on:click="$wire.agregarCompetencia({{ $competencia->id }}, $('#cchb{{ $competencia->id }}').is(':checked'));">
                                                <label
                                                    for="cchb{{ $competencia->id }}">{{ $competencia->nombre }}<p class="text-sm font-italic text-secondary"> {{ $competencia->descripcion }}</p></label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if ($competencias_selected == [])
                                    <span class="d-block text-danger invalid-feedback">Se requiere al menos una
                                        competencia</span>
                                @else
                                    <span class="d-block text-success valid-feedback">Campo correcto</span>
                                @endif
                                <div class="row mb-3">
                                    <div class="col">
                                        <div wire:ignore>
                                            <label for="currirulum_vitae.*">Currículum Vitae</label>
                                            <span class="d-tooltip parpadea" data-toggle="tooltip"
                                                data-placement="top" title="Campo obligatorio">*</span>
                                            <input type="file" name="currirulum_vitae" hidden
                                                accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" id="currirulum_vitae"
                                                class="form-control" wire:model="currirulum_vitae"
                                                placeholder="Ingrese el currículum vitae" autocomplete="off">
                                        </div>
                                        <a type="button" class="btn btn-primary"
                                            x-on:click="$('#currirulum_vitae').click()">
                                            <i class="fas fa-upload"></i>
                                            Subir Archivo
                                        </a>
                                        <!-- Vista previa si existe el archivo -->
                                        <div class="border mt-3 d-flex text-center justify-content-center align-items-center"
                                            style=" height: 150px; width: 150px;">
                                            @if (!$currirulum_vitae)

                                                <div class="text-secondary font-italic">
                                                    Vista previa no disponible
                                                </div>
                                            @else
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <div class="d-flex flex-column align-items-start">
                                                        <div data-toggle="tooltip" data-placement="bottom"
                                                            title="{{ $currirulum_vitae->getClientOriginalName() }}">
                                                            <div
                                                                class="d-flex justify-content-center align-items-center">
                                                                <div class="position-absolute"
                                                                    onclick="event.stopPropagation();"
                                                                    wire:click="eliminarCurriculumVitae('{{ $currirulum_vitae->getClientOriginalName() }}')">
                                                                    <i class="fas fa-trash eliminar_item"></i>
                                                                </div>
                                                                @if ($currirulum_vitae->guessExtension() == 'pdf')
                                                                    <img src="{{ asset('img/pdf.webp') }}"
                                                                        alt="" class="img-fluid"
                                                                        width="100">
                                                                @elseif ($currirulum_vitae->guessExtension() == 'docx' || $currirulum_vitae->guessExtension() == 'doc')
                                                                    <img src="{{ asset('img/word.webp') }}"
                                                                        alt="" class="img-fluid"
                                                                        width="100">
                                                                @else
                                                                    <img src="{{ $currirulum_vitae->temporaryUrl() }}"
                                                                        alt="" class="img-fluid"
                                                                        width="100">
                                                                @endif
                                                            </div>
                                                            <div class="d-block text-truncate"
                                                                style="max-width: 100px;">
                                                                {{ $currirulum_vitae->getClientOriginalName() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        @if ($this->currirulum_vitae == '')
                                            <span class="d-block text-danger invalid-feedback">Se requiere un
                                                currículum vitae valido</span>
                                        @endif
                                        @if ($this->currirulum_vitae != '')
                                            <span class="d-block text-success valid-feedback">Campo correcto</span>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="row mb-3 justify-content-center font-italic text-sm">
                                    <p>Actualmente no se registra un puesto de trabajo. Para agregar competencias debe
                                        seleccionar un puesto de trabajo.</p>
                                </div>
                            @endif
                            {{-- <a type="button" class="btn btn-secondary" x-on:click="$wire.getCompetencias()">Competencias</a> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>

                    @if (Auth::user()->hasRole('SYSADMIN|DIRECTOR GENERAL'))
                        <div class="card card-primary">
                            <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                                <h3 class="card-title">Rol del Empleado</h3>
                                <div class="card-tools">
                                    <a type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                                    </a>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col">
                                        <div wire:ignore>
                                            <label for="rol_seleccionado">Roles</label>
                                            <span class="d-tooltip parpadea" data-toggle="tooltip"
                                                data-placement="top" title="Campo obligatorio">*</span>
                                            <select name="rol_seleccionado" id="rol_seleccionado"
                                                class="form-control select2" name="state"
                                                aria-placeholder="Seleccione una opción">
                                                <option value="" selected>Seleccione una opción</option>
                                                @foreach ($roles as $rol)
                                                    <option value="{{ $rol->id }}">{{ $rol->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('rol_seleccionado')
                                            <span
                                                class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        @if (!$errors->get('rol_seleccionado') && $this->rol_seleccionado != null)
                                            <span class="d-block text-success valid-feedback">Campo correcto</span>
                                        @endif
                                    </div>
                                    <div class="col"></div>
                                    <div class="col"></div>
                                    <div class="col"></div>
                                </div>
                                {{-- <a type="button" class="btn btn-secondary" x-on:click="$wire.getCompetencias()">Competencias</a> --}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <a class="btn btn-primary" x-on:click="$wire.previousStep()">←</a>
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-save"></i>
                            Contratar Empleado
                        </button>
                        <a class="btn btn-primary" x-on:click="$wire.nextStep()">→</a>
                    </div>
                </div>
            </div>

        </div>

        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">

            <!-- Progress Bar -->
            <div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </div>
    </form>
</div>

<script>
    // In your Javascript (external .js resource or <script> tag)
    document.addEventListener("DOMContentLoaded", function() {

        window.editar_contacto = (telefono) => {
            Sweetalert2.fire({
                title: 'Editar Contacto de Emergencia',
                text: '¿Está seguro que desea editar el contacto de emergencia seleccionado?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, editar',
                cancelButtonText: 'No, salir',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.editarContactoEmergencia(telefono);
                }
            })
        }

        window.eliminar_contacto = (telefono) => {
            Sweetalert2.fire({
                title: 'Eliminar Contacto de Emergencia',
                text: '¿Está seguro que desea eliminar el contacto de emergencia seleccionado?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'No, salir',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.eliminarContactoEmergencia(telefono);
                }
            })
        }

        window.eliminar_familiar = (dni) => {
            Sweetalert2.fire({
                title: 'Eliminar Familiar',
                text: '¿Está seguro que desea eliminar el familiar seleccionado?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'No, salir',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.eliminarFamiliar(dni);
                }
            })
        }

        window.editar_familiar = (dni) => {
            Sweetalert2.fire({
                title: 'Editar Familiar',
                text: '¿Está seguro que desea editar el familiar seleccionado?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, editar',
                cancelButtonText: 'No, salir',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.editarFamiliar(dni);
                }
            })
        }

        Livewire.on('control_fecha', function(params) {
            if (params[0]){
                $("#fecha_vencimiento").flatpickr().destroy();
                $("#fecha_vencimiento").val('');
                $("#fecha_vencimiento").attr('readonly', true);
            }else{
                $("#fecha_vencimiento").attr('readonly', false);
                $("#fecha_vencimiento").flatpickr({
                    "locale": es.Spanish,
                    dateFormat: 'd-m-Y',
                    "minDate": new Date(new Date().setFullYear(new Date()
                        .getFullYear())),
                    "onChange": function() {
                        // Modificar
                        @this.set('fecha_vencimiento', $(
                            '#fecha_vencimiento').val());
                    },
                });
                $("#fecha_vencimiento").removeAttr('readonly')

            }
        });

        Livewire.on('limpiar_familiar', function(params) {
            $('#dni_familiar').val('');
            $('#nombre_familiar').val('');
            $('#apellido_familiar').val('');
            $('#sexo_selected_familiar').val('').trigger('change');
            $('#fecha_nacimiento_familiar').val('');
            $('#tipo_relacion_familiar_selected').val('').trigger('change');
            $('#certificado_familiar').val('').trigger('change');
        });

        Livewire.on('editar_familiar', function(params) {
            $('#sexo_selected_familiar').val(params[0]).trigger('change');
            $('#fecha_nacimiento_familiar').val(params[1]);
            $('#tipo_relacion_familiar_selected').val(params[2]).trigger('change');
        });

        Livewire.on('actualizar', function() {
            // delay for 1 second
            setTimeout(function() {
                $('#tipo_jornadas_selected').select2({
                    placeholder: 'Seleccione una opción',
                    width: '100%',
                }).on('change', function() {
                    // Modificar
                    @this.set('tipo_jornadas_selected', $('#tipo_jornadas_selected').val());
                    $('.ayuda_jornada').attr('hidden', true);
                    $('#ayuda_jornada_' + $('#tipo_jornadas_selected').val()).attr('hidden', false);
                });

                $('#tipo_contratos_selected').select2({
                    placeholder: 'Seleccione una opción',
                    width: '100%',
                }).on('change', function() {
                    // Modificar
                    @this.set('tipo_contratos_selected', $('#tipo_contratos_selected').val());
                    $('.ayuda_contrato').attr('hidden', true);
                    $('#ayuda_contrato_' + $('#tipo_contratos_selected').val()).attr('hidden', false);
                });

                $('#rol_seleccionado').select2({
                    placeholder: 'Seleccione una opción',
                    width: '100%',
                }).on('change', function() {
                    // Modificar
                    @this.set('rol_seleccionado', $('#rol_seleccionado')
                        .val());
                });

                $('#obra_social_selected').select2({
                    placeholder: 'Seleccione una opción',
                    width: '100%',
                }).on('change', function() {
                    // Modificar
                    @this.set('obra_social_selected', $('#obra_social_selected').val());
                });

                $('#tipo_relacion_familiar_selected').select2({
                    placeholder: 'Seleccione una opción',
                    width: '100%',
                }).on('change', function() {
                    // Modificar
                    @this.set('tipo_relacion_familiar_selected', $(
                        '#tipo_relacion_familiar_selected').val());
                });

                $('#tipo_relacion_familiar_selected_dos').select2({
                    placeholder: 'Seleccione una opción',
                    width: '100%',
                }).on('change', function() {
                    // Modificar
                    @this.set('tipo_relacion_familiar_selected_dos', $(
                        '#tipo_relacion_familiar_selected_dos').val());
                });

                $('#sexo_selected_familiar').select2({
                    placeholder: 'Seleccione una opción',
                    width: '100%',
                }).on('change', function() {
                    // Modificar
                    @this.set('sexo_selected_familiar', $('#sexo_selected_familiar')
                        .val());
                });

                $('#puesto_de_trabajo_selected').select2({
                    placeholder: 'Seleccione una opción',
                    width: '100%',
                }).on('change', function() {
                    // Modificar
                    @this.set('puesto_de_trabajo_selected', $(
                        '#puesto_de_trabajo_selected').val());
                });


                $("#fecha_nacimiento_familiar").flatpickr({
                    "locale": es.Spanish,
                    dateFormat: 'd-m-Y',
                    "minDate": new Date(new Date().setFullYear(new Date()
                        .getFullYear() - 120)),
                    "maxDate": new Date(new Date().setFullYear(new Date()
                        .getFullYear())),
                    "onChange": function() {
                        // Modificar
                        @this.set('fecha_nacimiento_familiar', $(
                            '#fecha_nacimiento_familiar').val());
                    },
                });
                $("#fecha_nacimiento_familiar").removeAttr('readonly')

                $("#fecha_ingreso").flatpickr({
                    "locale": es.Spanish,
                    dateFormat: 'd-m-Y',
                    "minDate": new Date(new Date().setFullYear(new Date()
                        .getFullYear() - 120)),
                    "maxDate": new Date(new Date().setFullYear(new Date()
                        .getFullYear())),
                    "onChange": function() {
                        // Modificar
                        @this.set('fecha_ingreso', $(
                            '#fecha_ingreso').val());
                    },
                });
                $("#fecha_ingreso").removeAttr('readonly')


                $("#fecha_vencimiento").flatpickr({
                    "locale": es.Spanish,
                    dateFormat: 'd-m-Y',
                    "minDate": new Date(new Date().setFullYear(new Date()
                        .getFullYear())),
                    "onChange": function() {
                        // Modificar
                        @this.set('fecha_vencimiento', $(
                            '#fecha_vencimiento').val());
                    },
                });
                $("#fecha_vencimiento").removeAttr('readonly')

                $("#hora_entrada").flatpickr({
                    "locale": es.Spanish,
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    "onChange": function() {
                        // Modificar
                        @this.set('hora_entrada', $(
                            '#hora_entrada').val());
                    },
                });
                $("#hora_entrada").removeAttr('readonly')

                $("#hora_salida").flatpickr({
                    "locale": es.Spanish,
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    "onChange": function() {
                        // Modificar
                        @this.set('hora_salida', $(
                            '#hora_salida').val());
                    },
                });
                $("#hora_salida").removeAttr('readonly')
                
                $("#hora_inicio_receso").flatpickr({
                    "locale": es.Spanish,
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    "onChange": function() {
                        // Modificar
                        @this.set('hora_inicio_receso', $(
                            '#hora_inicio_receso').val());
                    },
                });
                $("#hora_inicio_receso").removeAttr('readonly')

                $("#hora_fin_receso").flatpickr({
                    "locale": es.Spanish,
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    "onChange": function() {
                        // Modificar
                        @this.set('hora_fin_receso', $(
                            '#hora_fin_receso').val());
                    },
                });
                $("#hora_fin_receso").removeAttr('readonly')
            }, 200);
        })

        Livewire.on('error_critico', function(params) {

            const Toast = Sweetalert2.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Sweetalert2.stopTimer;
                    toast.onmouseleave = Sweetalert2.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: params[0]
            });
        });

        Livewire.on('success-contrato', function(message) {
            window.location.href = '/gestion/empleados/success';
        });


        Livewire.on('error-contrato', function(message) {
            Sweetalert2.fire({
                title: 'Error',
                text: message[0],
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false
            })
        });

        window.stepper = new Stepper($('.bs-stepper')[0], {
            linear: false,
            animation: true
        });

        $('#rol_seleccionado').select2({
            placeholder: 'Seleccione una opción',
            width: '100%',
        }).on('change', function() {
            // Modificar
            @this.set('rol_seleccionado', $('#rol_seleccionado')
                .val());
        });

        $('#tipo_relacion_familiar_selected_dos').select2({
            placeholder: 'Seleccione una opción',
            width: '100%',
        }).on('change', function() {
            // Modificar
            @this.set('tipo_relacion_familiar_selected_dos', $(
                '#tipo_relacion_familiar_selected_dos').val());
        });

        $('#puesto_de_trabajo_selected').select2({
            placeholder: 'Seleccione una opción',
            width: '100%',
        }).on('change', function() {
            // Modificar
            @this.set('puesto_de_trabajo_selected', $(
                '#puesto_de_trabajo_selected').val());
        });

        $("#fecha_ingreso").flatpickr({
            "locale": es.Spanish,
            dateFormat: 'd-m-Y',
            "minDate": new Date(new Date().setFullYear(new Date()
                .getFullYear() - 120)),
            "maxDate": new Date(new Date().setFullYear(new Date()
                .getFullYear())),
            "onChange": function() {
                // Modificar
                @this.set('fecha_ingreso', new Date($(
                    '#fecha_ingreso').val()).format('dd-mm-yyyy'));
            },
        });
        $("#fecha_ingreso").removeAttr('readonly')

        $("#fecha_vencimiento").flatpickr({
            "locale": es.Spanish,
            dateFormat: 'd-m-Y',
            "minDate": new Date(new Date().setFullYear(new Date()
                .getFullYear())),
            "onChange": function() {
                // Modificar
                @this.set('fecha_vencimiento', new Date($(
                    '#fecha_vencimiento').val()).format('dd-mm-yyyy'));
            },
        });
        $("#fecha_vencimiento").removeAttr('readonly')

        $("#hora_entrada").flatpickr({
            "locale": es.Spanish,
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            "onChange": function() {
                // Modificar
                @this.set('hora_entrada', $(
                    '#hora_entrada').val());
            },
        });
        $("#hora_entrada").removeAttr('readonly')

        $("#hora_salida").flatpickr({
            "locale": es.Spanish,
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            "onChange": function() {
                // Modificar
                @this.set('hora_salida', $(
                    '#hora_salida').val());
            },
        });
        $("#hora_salida").removeAttr('readonly')

        $("#hora_inicio_receso").flatpickr({
            "locale": es.Spanish,
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            "onChange": function() {
                // Modificar
                @this.set('hora_inicio_receso', $(
                    '#hora_inicio_receso').val());
            },
        });
        $("#hora_inicio_receso").removeAttr('readonly')

        $("#hora_fin_receso").flatpickr({
            "locale": es.Spanish,
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            "onChange": function() {
                // Modificar
                @this.set('hora_fin_receso', $(
                    '#hora_fin_receso').val());
            },
        });
        $("#hora_fin_receso").removeAttr('readonly')

        $('#tipo_jornadas_selected').select2({
            placeholder: 'Seleccione una opción',
            width: '100%',
        }).on('change', function() {
            // Modificar
            @this.set('tipo_jornadas_selected', $('#tipo_jornadas_selected').val());
            $('.ayuda_jornada').attr('hidden', true);
            $('#ayuda_jornada_' + $('#tipo_jornadas_selected').val()).attr('hidden', false);
        });

        $('#tipo_contratos_selected').select2({
            placeholder: 'Seleccione una opción',
            width: '100%',
        }).on('change', function() {
            // Modificar
            @this.set('tipo_contratos_selected', $('#tipo_contratos_selected').val());
            $('.ayuda_contrato').attr('hidden', true);
            $('#ayuda_contrato_' + $('#tipo_contratos_selected').val()).attr('hidden', false);
        });

        $('#pais_selected').select2({
            placeholder: 'Seleccione una opción',
            width: '100%',
        }).on('change', function() {
            // Modificar
            @this.set('pais_selected', $('#pais_selected').val());
            @this.getPais().then(function(result) {
                result = Object.values(result);
                result.sort((a, b) => a.nombre - b.nombre);
                aux = [];
                aux.push({
                    id: '',
                    text: 'Seleccione una opción'
                })
                //console.log(result);
                result.forEach(element => {
                    aux.push({
                        id: element.id,
                        text: element.nombre.replace(/['"]+/g, '')
                    })
                });
                if (result.length > 0) {
                    $('#provincia_selected').select2('destroy');
                    $('#provincia_selected').empty();
                    $('#provincia_selected').select2({
                        placeholder: 'Seleccione una opción',
                        width: '100%',
                        disabled: () => {
                            if ($('#pais_selected').val() == '') {
                                return true
                            } else {
                                return false
                            }
                        },
                        data: aux,
                    }).on('change', function() {
                        // Modificar
                        @this.set('provincia_selected', $('#provincia_selected').val())
                        @this.getProvincia().then(function(result) {
                            result = Object.values(result);
                            result.sort((a, b) => a.nombre - b.nombre);
                            aux = [];
                            aux.push({
                                id: '',
                                text: 'Seleccione una opción'
                            })
                            //console.log(result);
                            result.forEach(element => {
                                aux.push({
                                    id: element.id,
                                    text: element.nombre
                                        .replace(/['"]+/g, '')
                                })
                            });
                            if (result.length > 0) {
                                $('#municipio_selected').select2('destroy');
                                $('#municipio_selected').empty();
                                $('#municipio_selected').select2({
                                    placeholder: 'Seleccione una opción',
                                    width: '100%',
                                    disabled: () => {
                                        if ($('#provincia_selected')
                                            .val() == '') {
                                            return true
                                        } else {
                                            return false
                                        }
                                    },
                                    data: aux,
                                }).on('change', function() {
                                    // Modificar
                                    @this.set('municipio_selected', $(
                                            '#municipio_selected')
                                        .val())
                                });
                            }
                        });

                    });
                }
            });
        });

        $('#provincia_selected').select2({
            placeholder: 'Seleccione una opción',
            width: '100%',
            disabled: () => {
                if ($('#pais_selected').val() == '') {
                    return true
                } else {
                    return false
                }
            }
        });

        $('#municipio_selected').select2({
            placeholder: 'Seleccione una opción',
            width: '100%',
            disabled: () => {
                if ($('#provincia_selected').val() == '') {
                    return true
                } else {
                    return false
                }
            }
        });

        $('#sexo_selected').select2({
            placeholder: 'Seleccione una opción',
            width: '100%',
        }).on('change', function() {
            // Modificar
            @this.set('sexo_selected', $('#sexo_selected').val());
        });

        $('#estado_civil').select2({
            placeholder: 'Seleccione una opción',
            width: '100%',
        }).on('change', function() {
            // Modificar
            @this.set('estado_civil', $('#estado_civil').val());
        });

        $('.select2.select2-container.select2-container--default').css('width', '100%')

        $("#fecha_nacimiento").flatpickr({
            "locale": es.Spanish,
            dateFormat: 'd-m-Y',
            "minDate": new Date(new Date().setFullYear(new Date().getFullYear() - 120)),
            "maxDate": new Date(new Date().setFullYear(new Date().getFullYear() - 16)),
            "onChange": function() {
                // Modificar
                @this.set('fecha_nacimiento', $('#fecha_nacimiento').val());
            },
        });

        Livewire.on('stepperNext', function(params) {
            stepper.next()
        });

        Livewire.on('stepperPrevious', function(params) {
            stepper.previous()
        });

        $(function() {
            new bootstrap.Tooltip($('[data-toggle="tooltip"]'))
        })

        if ($('body').hasClass('dark-mode')) {
            $('.select2-selection__rendered').css('color', '#ffff')
            $('.select2-selection').addClass('form-control')
            var links = $("link");
            for (var i = 0; i < links.length; i++) {
                if (links[i].href.indexOf("dark.css") !== -1) {
                    links[i].href = links[i].href.replace(
                        "dark",
                        "flatpickr"
                    );
                }
            }
        }
    });
</script>
