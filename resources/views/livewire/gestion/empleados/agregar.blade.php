<div>
    <form wire:submit.prevent="guardarEmpleado">
        <div wire:ignore.self class="bs-stepper">
            <div wire:ignore.self class="bs-stepper-header" role="tablist">

                <!-- PRIMER HEADER -->
                <div wire:ignore.self class="step" data-target="#datos-personales">
                    <button wire:ignore.self type="button" class="step-trigger" role="tab"
                        aria-controls="datos-personales" id="datos-personales-trigger">
                        <span wire:ignore.self class="bs-stepper-circle">1</span>
                        <span wire:ignore.self class="bs-stepper-label">Datos Personales</span>
                    </button>
                </div>
                <div wire:ignore.self class="line"></div>

                <!-- SEGUNDO HEADER -->
                <div wire:ignore.self class="step" data-target="#datos-legajo">
                    <button type="button" class="step-trigger" role="tab" aria-controls="datos-legajo"
                        id="datos-legajo-trigger">
                        <span wire:ignore.self class="bs-stepper-circle">2</span>
                        <span wire:ignore.self class="bs-stepper-label">Datos de Empleado</span>
                    </button>
                </div>
            </div>


            <!-- PRIMER STEP -->
            <div wire:ignore.self class="bs-stepper-content">
                <div wire:ignore.self id="datos-personales" class="content" role="tabpanel"
                    aria-labelledby="datos-personales-trigger">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos Personales</h3>
                        </div>
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
                                            class="flatpickr form-control"
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
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
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
                                    <div wire:ignore>
                                        <label for="sexo_selected">Sexo</label>
                                        <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <select name="sexo_selected" id="sexo_selected" class="form-control select2"
                                            name="state" aria-placeholder="Seleccione una opción">
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
                                            name="state" aria-placeholder="Seleccione una opción">
                                            <option selected value="">Seleccione una opcion</option>
                                            @foreach ($estados_civiles as $estado_c)
                                                <option value="{{ $estado_c->id }}">{{ $estado_c->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('estado_civil')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                        {{-- <script>
                                            window.validarEstadoCivil = () => {
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
                                            validarEstadoCivil();
                                        </script> --}}
                                    @enderror
                                    @if (!$errors->get('estado_civil') && $this->estado_civil != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                            </div>

                            <!-- DOCUMENTOS PREOCUPACIONALES -->
                            <div class="mb-3">
                                <label for="dropzone-input">Documentos Pre-Ocupacionales</label>
                                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                                    title="Certificado de residencia, CV, solicitudes, entre otros">*</span>
                                <input id="dropzone-input" class="d-none" wire:model="archivos" type="file"
                                    multiple>
                                <div id="dropzone"
                                    class="d-flex rounded mt-2 mb-4 p-5 text-center justify-content-center align-items-center"
                                    style="cursor: pointer; border: 2px dashed #3d3d3d;">
                                    @if ($archivos)
                                        @foreach ($archivos as $archivo)
                                            <div class="d-flex flex-column align-items-center">

                                                <div data-toggle="tooltip" data-placement="bottom"
                                                    title="{{ $archivo->getClientOriginalName() }}">

                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <div class="position-absolute"
                                                            onclick="event.stopPropagation();"
                                                            wire:click="eliminarArchivo({{ $loop->index }})">
                                                            <i class="fas fa-trash eliminar_item"></i>
                                                        </div>
                                                        @if ($archivo->guessExtension() == 'pdf')
                                                            <img src="{{ asset('img/pdf.png') }}" alt=""
                                                                class="img-fluid" width="100">
                                                        @elseif ($archivo->guessExtension() == 'docx' || $archivo->guessExtension() == 'doc')
                                                            <img src="{{ asset('img/word.png') }}" alt=""
                                                                class="img-fluid" width="100">
                                                        @else
                                                            <img src="{{ $archivo->temporaryUrl() }}" alt=""
                                                                class="img-fluid" width="100">
                                                        @endif
                                                    </div>


                                                    <div class="d-block text-truncate" style="max-width: 100px;">
                                                        {{ $archivo->getClientOriginalName() }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-danger font-italic" id="dropzone-none">
                                            Ningun archivo seleccionado
                                        </div>
                                    @endif
                                </div>
                                @error('archivos.*')
                                    <span class="error">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <button class="btn btn-primary" x-on:click="$wire.previousStep()">←</button>
                        <button class="btn btn-primary" x-on:click="$wire.nextStep()">→</button>
                    </div>
                </div>

            </div>


            <!-- SEGUNDO STEP -->
            <div wire:ignore.self class="bs-stepper-content">
                <div wire:ignore.self id="datos-legajo" class="content" role="tabpanel"
                    aria-labelledby="datos-legajo-trigger">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Datos del Empleado: Apertura de Legajo</h3>
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <button class="btn btn-primary" x-on:click="$wire.previousStep()">←</button>
                        <button class="btn btn-primary" type="submit">Save Contact</button>
                        <button class="btn btn-primary" x-on:click="$wire.nextStep()">→</button>
                    </div>
                </div>
            </div>

        </div>

    </form>
</div>

<script>
    // In your Javascript (external .js resource or <script> tag)
    document.addEventListener("DOMContentLoaded", function() {

        Livewire.on('errorArchivo', function(params) {
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

        $('#dropzone').on('dragover', function() {
            $(this).attr('style', '')
        });

        $('#dropzone').on('click', function() {
            $('#dropzone-input').click();
        });

        window.stepper = new Stepper($('.bs-stepper')[0], {
            linear: false,
            animation: true
        });

        $('#pais_selected').select2({
            placeholder: 'Seleccione una opción',
            width: 'resolve',
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
                        width: 'resolve',
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
                                    width: 'resolve',
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
            width: 'resolve',
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
            width: 'resolve',
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
            width: 'resolve',
        }).on('change', function() {
            // Modificar
            @this.set('sexo_selected', $('#sexo_selected').val());
        });

        $('#estado_civil').select2({
            placeholder: 'Seleccione una opción',
            width: 'resolve',
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
