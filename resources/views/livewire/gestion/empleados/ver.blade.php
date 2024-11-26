<div>
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
                    <input readonly type="text" name="nombre" id="nombre" class="form-control"
                        value="{{ $persona->nombre }}" autocomplete="off">
                </div>
                <div class="col">
                    <label for="s_nombre">Segundo Nombre</label>
                    <input readonly type="text" name="s_nombre" id="s_nombre" class="form-control"
                        value="{{ $persona->segundo_nombre }}" autocomplete="off">
                </div>
                <div class="col">
                    <label for="apellido">Apellido</label>
                    <input readonly type="text" name="apellido" id="apellido" class="form-control"
                        value="{{ $persona->apellido }}" autocomplete="off">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="dni">DNI</label>
                    <input readonly type="text" name="dni" id="dni" class="form-control"
                        value="{{ $persona->dni }}" autocomplete="off">
                </div>
                <div class="col">
                    <label for="cuil">CUIL</label>
                    <input readonly type="text" name="cuil" id="cuil" class="form-control"
                        value="{{ $persona->cuil }}" placeholder="Ingrese el CUIL" autocomplete="off">
                </div>

                <div class="col">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input readonly type="text" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                        value="{{ $persona->fecha_nacimiento }}" autocomplete="off">
                </div>
            </div>
            <div class="row mb-3">

                <div class="col">
                    <label for="sexo_selected">Sexo</label>
                    <input readonly type="text" name="sexo_selected" id="sexo_selected" class="form-control"
                        value="{{ $persona->sexo->nombre }}" autocomplete="off">
                </div>
                <div class="col">
                    <label for="estado_civil">Estado Civil</label>
                    <input readonly type="text" name="estado_civil" id="estado_civil" class="form-control"
                        value="{{ $persona->estadoCivil->nombre }}" autocomplete="off">
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
                <div class="col"></div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <div wire:ignore>
                        <label for="certificado_domicilio">Certificado de Domicilio</label>
                        <input type="file" name="certificado_domicilio" hidden
                            accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" id="certificado_domicilio" class="form-control"
                            wire:model="certificado_domicilio" placeholder="Ingrese el certificado de domicilio"
                            autocomplete="off">
                    </div>
                    <a type="button" class="btn btn-primary" x-on:click="$('#certificado_domicilio').click()">
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
                                            <div class="position-absolute" onclick="event.stopPropagation();"
                                                wire:click="eliminarCertificadoDomicilio('{{ $certificado_domicilio->getClientOriginalName() }}')">
                                                <i class="fas fa-trash eliminar_item"></i>
                                            </div>
                                            @if ($certificado_domicilio->guessExtension() == 'pdf')
                                                <img src="{{ asset('img/pdf.png') }}" alt=""
                                                    class="img-fluid" width="100">
                                            @elseif ($certificado_domicilio->guessExtension() == 'docx' || $autorizacion_padres->guessExtension() == 'doc')
                                                <img src="{{ asset('img/word.png') }}" alt=""
                                                    class="img-fluid" width="100">
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
                    @endif declara bajo juramento poseer familiares a su cargo, ya
                    sea cónyuge, hijos u otros dependientes
                    económicos, y se compromete a informar cualquier cambio que modifique el
                    contenido de esta declaración.
                </p>
                <div class="icheck-primary icheck-inline">
                    <input type="checkbox" id="chb" name="chb" wire:model="tiene_familiares"
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
                            <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                title="Campo obligatorio">*</span>
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
                        <input wire:model="dni_familiar" type="text" name="dni_familiar" id="dni_familiar"
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
                            <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                title="Campo obligatorio">*</span>
                            <input name="fecha_nacimiento_familiar" id="fecha_nacimiento_familiar"
                                class="flatpickr form-control" placeholder="Seleccione la fecha de nacimiento">
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
                            <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                title="Campo obligatorio">*</span>
                            <select name="tipo_relacion_familiar_selected" id="tipo_relacion_familiar_selected"
                                class="form-control select2" aria-placeholder="Seleccione una opción">
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
                            <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                title="Campo obligatorio">*</span>
                            <input type="file" name="certificado_familiar" hidden
                                accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" id="certificado_familiar"
                                class="form-control" wire:model="certificado_familiar"
                                placeholder="Ingrese el certificado de discapacidad" autocomplete="off">
                        </div>
                        <a type="button" class="btn btn-primary" x-on:click="$('#certificado_familiar').click()">
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
                                            <div class="d-flex justify-content-center align-items-center">
                                                <div class="position-absolute" onclick="event.stopPropagation();"
                                                    wire:click="eliminarCertificadoFamiliar('{{ $certificado_familiar->getClientOriginalName() }}')">
                                                    <i class="fas fa-trash eliminar_item"></i>
                                                </div>
                                                @if ($certificado_familiar->guessExtension() == 'pdf')
                                                    <img src="{{ asset('img/pdf.png') }}" alt=""
                                                        class="img-fluid" width="100">
                                                @elseif ($certificado_familiar->guessExtension() == 'docx' || $certificado_familiar->guessExtension() == 'doc')
                                                    <img src="{{ asset('img/word.png') }}" alt=""
                                                        class="img-fluid" width="100">
                                                @else
                                                    <img src="{{ $certificado_familiar->temporaryUrl() }}"
                                                        alt="" class="img-fluid" width="100">
                                                @endif
                                            </div>
                                            <div class="d-block text-truncate" style="max-width: 100px;">
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
                                                    <div class="d-block text-truncate" style="max-width: 120px;"
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
                    <input type="checkbox" id="chb2" name="chb2" wire:model="tiene_obra_social"
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
                            <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                title="Campo obligatorio">*</span>
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
                    <input wire:model="email" type="text" name="email" id="email"
                        class="form-control @if (!$errors->get('') && $this->email != null) border-success is-valid @endif @error('email') border-danger is-invalid @enderror"
                        x-on:input="$wire.set('email', $('#email').val());" placeholder="Ingrese el email"
                        autocomplete="off">
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
                    <label for="telefono_emergencia">Telefono de Emergencia</label>
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
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contactos_emergencia as $contacto)
                                <tr>
                                    <td>{{ $contacto['nombre'] }}</td>
                                    <td>{{ $contacto['telefono'] }}</td>
                                    <td>{{ $contacto['email'] }}</td>
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
                    <div wire:ignore>
                        <label for="hora_entrada">Hora de Entrada</label>
                        <input name="hora_entrada" id="hora_entrada" class="flatpickr form-control"
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
                        <label for="hora_salida">Hora de Salida</label>
                        <input name="hora_salida" id="hora_salida" class="flatpickr form-control"
                            placeholder="Seleccione la hora de entrada">
                    </div>
                    @error('hora_salida')
                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                    @enderror
                    @if (!$errors->get('hora_salida') && $this->hora_salida != null)
                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                    @endif
                </div>
                <div class="col">
                    <label for="sueldo">Sueldo Bruto</label>
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

                    @error('sueldo')
                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                    @enderror
                    @if (!$errors->get('sueldo') && $this->sueldo != null)
                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                    @endif
                </div>
            </div>
            <p>Información de ingreso al puesto de trabajo</p>
            <div class="row mb-3">
                <div class="col">
                    <div wire:ignore>
                        <label for="fecha_ingreso">Fecha de Ingreso</label>
                        <input name="fecha_ingreso" id="fecha_ingreso" class="flatpickr form-control"
                            placeholder="Seleccione la fecha de ingreso">
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
                        <input name="fecha_vencimiento" id="fecha_vencimiento" class="flatpickr form-control"
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
                        <select name="tipo_contratos_selected" id="tipo_contratos_selected"
                            class="form-control select2" aria-placeholder="Seleccione una opción">
                            <option selected value="">Seleccione una opcion</option>
                            @foreach ($tipo_contratos as $tipo_contrato)
                                <option value="{{ $tipo_contrato->id }}">
                                    {{ $tipo_contrato->nombre }}</option>
                            @endforeach
                        </select>
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
                        <select name="tipo_jornadas_selected" id="tipo_jornadas_selected"
                            class="form-control select2" aria-placeholder="Seleccione una opción">
                            <option selected value="">Seleccione una opcion</option>
                            @foreach ($tipo_jornadas as $tipo_jornada)
                                <option value="{{ $tipo_jornada->id }}">
                                    {{ $tipo_jornada->nombre }}</option>
                            @endforeach
                        </select>
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
                <div class="row mb-3">
                    <div class="col">
                        <div wire:ignore>
                            <label for="contrato_trabajo.*">Contrato de Trabajo</label>
                            <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                title="Campo obligatorio">*</span>
                            <input type="file" name="contrato_trabajo" hidden
                                accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" id="contrato_trabajo" class="form-control"
                                wire:model="contrato_trabajo" placeholder="Ingrese el contrato de trabajo"
                                autocomplete="off">
                        </div>
                        <a type="button" class="btn btn-primary" x-on:click="$('#contrato_trabajo').click()">
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
                                            <div class="d-flex justify-content-center align-items-center">
                                                <div class="position-absolute" onclick="event.stopPropagation();"
                                                    wire:click="eliminarContratoTrabajo('{{ $contrato_trabajo->getClientOriginalName() }}')">
                                                    <i class="fas fa-trash eliminar_item"></i>
                                                </div>
                                                @if ($contrato_trabajo->guessExtension() == 'pdf')
                                                    <img src="{{ asset('img/pdf.png') }}" alt=""
                                                        class="img-fluid" width="100">
                                                @elseif ($contrato_trabajo->guessExtension() == 'docx' || $contrato_trabajo->guessExtension() == 'doc')
                                                    <img src="{{ asset('img/word.png') }}" alt=""
                                                        class="img-fluid" width="100">
                                                @else
                                                    <img src="{{ $contrato_trabajo->temporaryUrl() }}" alt=""
                                                        class="img-fluid" width="100">
                                                @endif
                                            </div>
                                            <div class="d-block text-truncate" style="max-width: 100px;">
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
                                    name="cchb{{ $competencia->id }}" value="{{ $competencia->id }}"
                                    x-on:click="$wire.agregarCompetencia({{ $competencia->id }}, $('#cchb{{ $competencia->id }}').is(':checked'));">
                                <label for="cchb{{ $competencia->id }}">{{ $competencia->nombre }}</label>
                            </div>
                        </div>
                        <div class="col"></div>
                        <div class="col"></div>
                        <div class="col"></div>
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
                            <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                title="Campo obligatorio">*</span>
                            <input type="file" name="currirulum_vitae" hidden
                                accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" id="currirulum_vitae" class="form-control"
                                wire:model="currirulum_vitae" placeholder="Ingrese el currículum vitae"
                                autocomplete="off">
                        </div>
                        <a type="button" class="btn btn-primary" x-on:click="$('#currirulum_vitae').click()">
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
                                            <div class="d-flex justify-content-center align-items-center">
                                                <div class="position-absolute" onclick="event.stopPropagation();"
                                                    wire:click="eliminarCurriculumVitae('{{ $currirulum_vitae->getClientOriginalName() }}')">
                                                    <i class="fas fa-trash eliminar_item"></i>
                                                </div>
                                                @if ($currirulum_vitae->guessExtension() == 'pdf')
                                                    <img src="{{ asset('img/pdf.png') }}" alt=""
                                                        class="img-fluid" width="100">
                                                @elseif ($currirulum_vitae->guessExtension() == 'docx' || $currirulum_vitae->guessExtension() == 'doc')
                                                    <img src="{{ asset('img/word.png') }}" alt=""
                                                        class="img-fluid" width="100">
                                                @else
                                                    <img src="{{ $currirulum_vitae->temporaryUrl() }}"
                                                        alt="" class="img-fluid" width="100">
                                                @endif
                                            </div>
                                            <div class="d-block text-truncate" style="max-width: 100px;">
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
</div>
