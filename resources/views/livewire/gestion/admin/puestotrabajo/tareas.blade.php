<div>
    <div class="modal fade" id="modal-default-tarea" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Vista previa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col mb-2">
                        <label for="vista_nombre">Nombre</label>
                        <input type="text" name="vista_nombre" id="vista_nombre" class="form-control" disabled
                            value="{{ $this->vista_nombre }}">
                    </div>
                    <div class="col mb-2">
                        <label for="vista_descripcion">Descripción</label>
                        <textarea name="vista_descripcion" id="vista_descripcion" class="form-control" disabled>{{ $this->vista_descripcion }}</textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Regresar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="row mb-3">
        <div class="col">
            <div wire:ignore>
                <label for="tarea_seleccionada">Tarea</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <select name="tarea_seleccionada" id="tarea_seleccionada" class="form-control select2"
                    name="tarea_seleccionada" aria-placeholder="Seleccione una opción">
                    <option selected value="">Seleccione una opcion</option>
                    @foreach ($tareas as $tarea)
                        <option value="{{ $tarea->id }}">{{ strtoupper($tarea->nombre) }}</option>
                    @endforeach
                </select>
            </div>
            @if ($this->editando == true && $this->tarea_seleccionada != null)
                <span class="flex text-warning parpadea"><strong>Editando</strong></span>
            @endif
        </div>
        <div wire:ignore class="row mx-2">
            <div class="mr-1">
                <label for="edit-btn-tarea">Editar</label>
                <span class="o-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Acción para editar la tarea selecccionada">?</span>
                <br>
                <button name="edit-btn-tarea" id="edit-btn-tarea" class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                </button>
                <button hidden name="cancelar-btn-tarea" id="cancelar-btn-tarea" class="btn btn-danger">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="ml-1">
                <label for="ver-btn">Ver</label>
                <br>
                <button name="ver-btn" id="ver-btn" class="btn btn-secondary" data-toggle="modal"
                    data-target="#modal-default-tarea">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
    </div>
    <form wire:submit.prevent="guardar">
        <div class="row mb-3">
            <div class="col">
                <label for="nombre_tarea">Nombre</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <input wire:model="nombre_tarea" type="text" name="nombre_tarea" id="nombre_tarea"
                    class="form-control @if (!$errors->get('') && $this->nombre_tarea != null) border-success is-valid @endif  @error('nombre_tarea') border-danger is-invalid @enderror"
                    x-on:input="$wire.set('nombre_tarea', $('#nombre_tarea').val());" placeholder="Ingrese el nombre"
                    autocomplete="off">
                @error('nombre_tarea')
                    <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                @enderror
                @if (!$errors->get('nombre_tarea') && $this->nombre_tarea != null)
                    <span class="d-block text-success valid-feedback">Campo correcto</span>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="descripcion_tarea">Descripción</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <textarea wire:model="descripcion_tarea" type="text" name="descripcion_tarea" id="descripcion_tarea"
                    class="form-control @if (!$errors->get('') && $this->descripcion_tarea != null) border-success is-valid @endif  @error('descripcion_tarea') border-danger is-invalid @enderror"
                    x-on:input="$wire.set('descripcion_tarea', $('#descripcion_tarea').val());" placeholder="Ingrese la descripcion"
                    autocomplete="off">
                </textarea>
                @error('descripcion_tarea')
                    <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                @enderror
                @if (!$errors->get('descripcion_tarea') && $this->descripcion_tarea != null)
                    <span class="d-block text-success valid-feedback">Campo correcto</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <button id="cancelarTarea" name="cancelarTarea" type="button" class="btn btn-secondary mx-1">
                    <i class="fas fa-stop"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-success mx-1" @if ($this->nombre_tarea == '' || $this->descripcion_tarea == '') disabled @endif>
                    <i class="fas fa-save"></i> Guardar
                </button>
                <button id="eliminarTarea" name="eliminarTarea" type="button" class="btn btn-danger mx-1" @if (!$this->editando) disabled @endif>
                    <i class="fas fa-eraser"></i> Eliminar
                </button>
            </div>
        </div>
    </form>
</div>
<script>
    // In your Javascript (external .js resource or <script> tag)
    document.addEventListener("DOMContentLoaded", function() {
        function editarTarea() {
            Sweetalert2.fire({
                title: 'Modo Edición',
                text: '¿Desea editar la tarea seleccionada?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, editar',
                cancelButtonText: 'No, salir',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    editandoTarea();
                    @this.editar();
                }
            })
        }

        $('#eliminarTarea').on('click', function() {
            Sweetalert2.fire({
                title: 'Eliminar Tarea',
                text: '¿Desea eliminar la tarea seleccionada?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'No, salir',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.eliminar();
                }
            })
        }); 

        $('#cancelarTarea').on('click', function() {
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
                    cancelarTarea();
                    @this.clear();
                }
            })
        });

        $('#cancelar-btn-tarea').on('click', function() {
            Sweetalert2.fire({
                title: 'Cancelar Edición',
                text: '¿Desea cancelar la edición de la tarea seleccionada?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, cancelar',
                cancelButtonText: 'No, salir',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    cancelarTarea();
                    @this.clear();
                }
            })
        });

        function cancelarTarea() {
            $('#edit-btn-tarea').removeAttr('hidden');
            $('#cancelar-btn-tarea').attr('hidden', true);
            $('#tarea_seleccionada').attr('disabled', false);
        }

        function editandoTarea() {
            $('#edit-btn-tarea').attr('hidden', true);
            $('#cancelar-btn-tarea').removeAttr('hidden');
            $('#tarea_seleccionada').attr('disabled', true);
        }

        $('#edit-btn-tarea').on('click', function() {
            if ($('#tarea_seleccionada').val() != '') {
                editarTarea();
            } else {
                Sweetalert2.fire({
                    title: 'Tarea no seleccionada',
                    text: 'Seleccione una tarea para editar',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                })
            }
        });

        $('#tarea_seleccionada').select2({
            placeholder: 'Seleccione una opción',
            width: 'resolve',
        }).on('change', function() {
            @this.set('tarea_seleccionada', $('#tarea_seleccionada').val());
            if (@this.editandoTarea == true) {
                cancelarTarea();
                @this.clear();
            }
        });

        Livewire.on('limpiar_formulario_tarea', function(params) {
            $('#nombre_tarea').val(params[0]);
            $('#descripcion_tarea').val(params[1]);
            $('#tarea_seleccionada').val(params[2]).trigger('change');
        });

        Livewire.on('success_tarea', function(message) {
            Sweetalert2.fire({
                title: 'Tarea Guardada',
                text: message[0],
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false
            }).then((result) => {
                //window.location.reload(); 
                $('#tarea_seleccionada').select2('destroy');
                $('#tarea_seleccionada').empty();
                @this.getTareas().then(function(result) {
                        /* manejar un resultado exitoso */
                        // Transformar result a array
                        result_tareas = Object.values(result);

                        let tareas = [];
                        tareas.push({
                            id: null,
                            text: 'Seleccione una opción',
                            selected: true,
                            disabled: false,
                        });

                        for (let i = 0; i < result_tareas.length; i++) {
                            // Cargar en tareas los atributos id y text que referencian a id y name del rol en result_tareas[i]
                            tareas.push({
                                id: result_tareas[i].id,
                                text: result_tareas[i].nombre
                            });
                        }

                        // Ordenar por campo id dejando el id null al inicio
                        tareas.sort((a, b) => a.id - b.id);

                        $('#tarea_seleccionada').select2({
                            placeholder: 'Seleccione una opción',
                            width: 'resolve',
                            data: tareas
                        });
                        $('#tarea_seleccionada').on('change', function() {
                            @this.set('tarea_seleccionada', $('#tarea_seleccionada')
                                .val());
                            if (@this.editando == true) {
                                cancelarTarea();
                                @this.clear();
                            }
                        });
                        cancelarTarea();
                        @this.clear();
                    },
                    function(error) {
                        /* manejar un error */
                        // mensaje de error en sweetalert2
                        Sweetalert2.fire({
                            title: 'Error',
                            text: 'Error al cargar los tareas',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Recargar',
                            allowOutsideClick: false
                        }).then((result) => {
                            window.location.reload();
                        });
                    });
            })
        });

        Livewire.on('error_tarea', function(message) {
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
