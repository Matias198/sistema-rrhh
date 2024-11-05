<div>
    <form wire:submit.prevent="guardar">
        <div class="row mb-3">
            <div class="col">
                <label for="titulo_puesto">Titulo del Puesto</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <input wire:model="titulo_puesto" type="text" name="titulo_puesto" id="titulo_puesto"
                    class="form-control 
                    @if (!$errors->get('') && $this->titulo_puesto != null) border-success @endif  
                    @error('titulo_puesto') border-danger @enderror"
                    x-on:input="$wire.set('titulo_puesto', $('#titulo_puesto').val());" placeholder="Ingrese el nombre"
                    autocomplete="off">
                @error('titulo_puesto')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
                @if (!$errors->get('titulo_puesto') && $this->titulo_puesto != null)
                    <span class="flex text-success">Campo correcto</span>
                @endif
            </div>
            <div class="col">
                <div wire:ignore>
                    <label for="departamento_seleccionado">Departamento</label>
                    <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                        title="Campo obligatorio">*</span>
                    <span class="o-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                        title="Ubicación del puesto en el organigrama de la empresa">?</span>
                    <select name="departamento_seleccionado" id="departamento_seleccionado"
                        class="form-control select2 
                        @if (!$errors->get('') && $this->departamento_seleccionado != null) border-success @endif  
                        @error('departamento_seleccionado') border-danger @enderror"
                        name="departamento_seleccionado" aria-placeholder="Seleccione una opción">
                        <option selected value="">Seleccione una opcion</option>
                        @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id }}">{{ strtoupper($departamento->nombre) }}</option>
                        @endforeach
                    </select>
                </div>
                @error('departamento_seleccionado')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
                @if (!$errors->get('departamento_seleccionado') && $this->departamento_seleccionado != null)
                    <span class="flex text-success">Campo correcto</span>
                @endif
            </div>
            <div class="col">
                <label for="sueldo_base">Sueldo Base</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <input wire:model="sueldo_base" type="number" name="sueldo_base" id="sueldo_base"
                    class="form-control 
                    @if (!$errors->get('') && $this->sueldo_base != null) border-success @endif  
                    @error('sueldo_base') border-danger @enderror"
                    x-on:input="$wire.set('sueldo_base', $('#sueldo_base').val());" placeholder="Ingrese el sueldo base"
                    autocomplete="off">
                @error('sueldo_base')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
                @if (!$errors->get('sueldo_base') && $this->sueldo_base != null)
                    <span class="flex text-success">Campo correcto</span>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="descripcion_puesto">Descripción genérica</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <span class="o-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Descripción genérica con un maximo de 255 caracteres">?</span>
                <textarea wire:model="descripcion_puesto" type="text" name="descripcion_puesto" id="descripcion_puesto"
                    class="form-control @if (!$errors->get('') && $this->descripcion_puesto != null) border-success @endif  @error('descripcion_puesto') border-danger @enderror"
                    x-on:input="$wire.set('descripcion_puesto', $('#descripcion_puesto').val());"
                    placeholder="Ingrese una descripción genérica" autocomplete="off">
                </textarea>
                @error('descripcion_puesto')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
                @if (!$errors->get('descripcion_puesto') && $this->descripcion_puesto != null)
                    <span class="flex text-success">Campo correcto</span>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div wire:ignore>
                    <label for="tareas_seleccionadas">Tareas o atribuciónes asignadas</label>
                    <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                        title="Campo obligatorio">*</span>
                    <span class="o-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                        title="Lista de tareas disponibles a la izquierda. Lista de tareas asignadas a la derecha">?</span>
                    <select id="tareas_seleccionadas" multiple="multiple" size="10" name="tareas_seleccionadas[]">
                        @foreach ($tareas as $tarea)
                            <option value="{{ $tarea->id }}">{{ $tarea->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                @error('tareas_seleccionadas')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
                @if (!$errors->get('tareas_seleccionadas') && $this->tareas_seleccionadas != null)
                    <span class="flex text-success">Campo correcto</span>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div wire:ignore>
                    <label for="capacidades_seleccionadas">Capacidades necesarias o factores de especificación</label>
                    <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                        title="Campo obligatorio">*</span>
                    <span class="o-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                        title="Lista de capacidades disponibles a la izquierda. Lista de capacidades asignadas a la derecha">?</span>
                    <select id="capacidades_seleccionadas" multiple="multiple" size="10"
                        name="capacidades_seleccionadas[]">
                        @foreach ($capacidades as $capacidad)
                            <option value="{{ $capacidad->id }}">{{ $capacidad->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                @error('capacidades_seleccionadas')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
                @if (!$errors->get('capacidades_seleccionadas') && $this->capacidades_seleccionadas != null)
                    <span class="flex text-success">Campo correcto</span>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                @if ($capacidades_seleccionadas != null)
                    <label for="contenedor-excluyentes">Seleccionar las capacidades exluyentes para el puesto de trabajo.</label>
                    <span class="o-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                        title="Marcar si y solo si la capacidad es exluyente para el puesto de trabajo">?</span>
                    <div id="contenedor-excluyentes">
                        @foreach ($capacidades_seleccionadas as $capacidad_id)
                            @foreach ($capacidades as $capacidad)
                                @if ($capacidad->id == $capacidad_id)
                                    <div class="icheck-danger icheck-inline">
                                        <input type="checkbox" id="chb{{ $capacidad->id }}" 
                                        x-on:click="$wire.agregarExcluyente({{ $capacidad->id }});"/>
                                        <label for="chb{{ $capacidad->id }}">{{ $capacidad->nombre }}</label>
                                    </div>
                                @endif
                                @if ($loop->last)
                                    <br>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-end">
                <button id="cancelarTrabajo" name="cancelarTrabajo" type="button" class="btn btn-danger">
                    <i class="fas fa-eraser"></i> Cancelar
                </button>
            </div>
            <div class="col d-flex justify-content-start">
                <button type="submit" class="btn btn-success" @if ($errors->any()) disabled @endif>
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#departamento_seleccionado').select2({
                placeholder: 'Seleccione una opción',
                width: 'resolve',
            }).on('change', function() {
                @this.set('departamento_seleccionado', $('#departamento_seleccionado').val());
            });

            $('select[name="tareas_seleccionadas[]"]').bootstrapDualListbox({});
            $('select[name="tareas_seleccionadas[]"]').on('change', function() {
                @this.set('tareas_seleccionadas', $('#tareas_seleccionadas').val());
            });


            $('select[name="capacidades_seleccionadas[]"]').bootstrapDualListbox({});
            $('select[name="capacidades_seleccionadas[]"]').on('change', function() {
                @this.set('capacidades_seleccionadas', $('#capacidades_seleccionadas').val());
            });

            window.limpiarCapacidadesDualbox = () => {
                $('select[name="capacidades_seleccionadas[]"]').empty();
                @this.getCapacidades().then(function(result) {
                        /* manejar un resultado exitoso */
                        // Transformar result a array
                        result_capacidades = Object.values(result);
                        let capacidades = [];
                        for (let i = 0; i < result_capacidades.length; i++) {
                            // Appendear al array de capacidades
                            if (result_capacidades[i].selected) {
                                capacidades.push({
                                    id: result_capacidades[i].id,
                                    text: result_capacidades[i].nombre,
                                    selected: true
                                });
                            } else {
                                capacidades.push({
                                    id: result_capacidades[i].id,
                                    text: result_capacidades[i].nombre,
                                    selected: false
                                });
                            }
                        }
                        // Ordenar las capacidades por id
                        capacidades.sort((a, b) => a.id - b.id);

                        // Por cada tarea appendear un option al select
                        for (let i = 0; i < capacidades.length; i++) {
                            if (capacidades[i].selected) {
                                $('select[name="capacidades_seleccionadas[]"]').append('<option value="' +
                                    capacidades[i].id + '" selected>' + capacidades[i].text +
                                    '</option>');
                            } else {
                                $('select[name="capacidades_seleccionadas[]"]').append('<option value="' +
                                    capacidades[i].id + '">' + capacidades[i].text + '</option>');
                            }
                        }

                        // Actualizar el dualbox
                        $('select[name="capacidades_seleccionadas[]"]').bootstrapDualListbox('refresh');
                        console.log(capacidades);
                    },
                    function(error) {
                        /* manejar un error */
                        // mensaje de error en sweetalert2
                        Sweetalert2.fire({
                            title: 'Error',
                            text: 'Error al cargar los tareas y permisos',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Recargar',
                            allowOutsideClick: false
                        }).then((result) => {
                            window.location.reload();
                        });
                    });
            }

            window.limpiarTareasDualbox = () => {
                $('select[name="tareas_seleccionadas[]"]').empty();
                @this.getTareas().then(function(result) {
                        /* manejar un resultado exitoso */
                        // Transformar result a array
                        result_tareas = Object.values(result);
                        let tareas = [];
                        for (let i = 0; i < result_tareas.length; i++) {
                            // Appendear al array de tareas
                            if (result_tareas[i].selected) {
                                tareas.push({
                                    id: result_tareas[i].id,
                                    text: result_tareas[i].nombre,
                                    selected: true
                                });
                            } else {
                                tareas.push({
                                    id: result_tareas[i].id,
                                    text: result_tareas[i].nombre,
                                    selected: false
                                });
                            }
                        }
                        // Ordenar las tareas por id
                        tareas.sort((a, b) => a.id - b.id);

                        // Por cada tarea appendear un option al select
                        for (let i = 0; i < tareas.length; i++) {
                            if (tareas[i].selected) {
                                $('select[name="tareas_seleccionadas[]"]').append('<option value="' +
                                    tareas[i].id + '" selected>' + tareas[i].text + '</option>');
                            } else {
                                $('select[name="tareas_seleccionadas[]"]').append('<option value="' +
                                    tareas[i].id + '">' + tareas[i].text + '</option>');
                            }
                        }

                        // Actualizar el dualbox
                        $('select[name="tareas_seleccionadas[]"]').bootstrapDualListbox('refresh');
                        console.log(tareas);
                    },
                    function(error) {
                        /* manejar un error */
                        // mensaje de error en sweetalert2
                        Sweetalert2.fire({
                            title: 'Error',
                            text: 'Error al cargar los tareas y permisos',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Recargar',
                            allowOutsideClick: false
                        }).then((result) => {
                            window.location.reload();
                        });
                    });
            }

            Livewire.on('success_tarea', () => {
                limpiarTareasDualbox();
            });

            Livewire.on('success_capacidad', () => {
                limpiarCapacidadesDualbox();
            });

            Livewire.on('limpiar-formulario-puesto-trabajo', function(params) {
                $('#titulo_puesto').val(params[0]);
                $('#descripcion_puesto').val(params[1]);
                $('#sueldo_base').val(params[2]);
                $('#departamento_seleccionado').val(params[3]);
                $('#tareas_seleccionadas').val(params[4]);
                $('#capacidades_seleccionadas').val(params[5]);
                limpiarCapacidadesDualbox();
                limpiarTareasDualbox();
            });

            $('#cancelarTrabajo').on('click', function() {
                Sweetalert2.fire({
                    title: 'Cancelar Formulario',
                    text: '¿Desea cancelar y limpiar el formulario?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, cancelar',
                    cancelButtonText: 'No, salir',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.clear();
                    }
                })
            });


            Livewire.on('success-trabajo', function(message) {
                Sweetalert2.fire({
                    title: 'Capacidad Guardada',
                    text: message[0],
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                    allowOutsideClick: false
                }).then((result) => {
                    @this.clear();
                });

            });

            Livewire.on('error-trabajo', function(message) {
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

            $('.select2.select2-container.select2-container--default').css('width', '100%')

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
</div>
