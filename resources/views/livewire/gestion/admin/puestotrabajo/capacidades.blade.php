<div>
    <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Vista previa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="vista_nombre">Nombre</label>
                            <input type="text" name="vista_nombre" id="vista_nombre" class="form-control" disabled
                                value="{{ $this->vista_nombre }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="vista_descripcion">Descripción</label>
                            <textarea name="vista_descripcion" id="vista_descripcion" class="form-control" disabled>{{ $this->vista_descripcion }}</textarea>
                        </div>
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
                <label for="capacidad_seleccionada">Capacidad</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <select name="capacidad_seleccionada" id="capacidad_seleccionada"
                    class="form-control select2 capacidad-select2" name="state"
                    aria-placeholder="Seleccione una opción">
                    <option selected value="">Seleccione una opcion</option>
                    @foreach ($capacidades as $capacidad)
                        <option value="{{ $capacidad->id }}">{{ strtoupper($capacidad->nombre) }}</option>
                    @endforeach
                </select>
            </div>
            @if ($this->editando == true && $this->capacidad_seleccionada != null)
                <span class="flex text-warning parpadea"><strong>Editando</strong></span>
            @endif
        </div>
        <div wire:ignore class="row mx-2">
            <div class="mr-1">
                <label for="edit-btn-capacidad">Editar</label>
                <span class="o-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Acción para editar el rol selecccionado">?</span>
                <br>
                <button name="edit-btn-capacidad" id="edit-btn-capacidad" class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                </button>
                <button hidden name="cancelar-btn-capacidad" id="cancelar-btn-capacidad" class="btn btn-danger">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="ml-1">
                <label for="ver-btn">Ver</label>
                <br>
                <button name="ver-btn" id="ver-btn" class="btn btn-secondary" data-toggle="modal"
                    data-target="#modal-default">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
    </div>
    <form wire:submit.prevent="guardar">
        <div class="row mb-3">
            <div class="col">
                <label for="nombre_capacidad">Nombre</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <input wire:model="nombre_capacidad" type="text" name="nombre_capacidad" id="nombre_capacidad"
                    class="form-control @if (!$errors->get('') && $this->nombre_capacidad != null) border-success @endif  @error('nombre_capacidad') border-danger @enderror"
                    x-on:input="$wire.set('nombre_capacidad', $('#nombre_capacidad').val());"
                    placeholder="Ingrese el nombre" autocomplete="off">
                @error('nombre_capacidad')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
                @if (!$errors->get('nombre_capacidad') && $this->nombre_capacidad != null)
                    <span class="flex text-success">Campo correcto</span>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="descripcion_capacidad">Descripción</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <textarea wire:model="descripcion_capacidad" type="text" name="descripcion_capacidad" id="descripcion_capacidad"
                    class="form-control @if (!$errors->get('') && $this->descripcion_capacidad != null) border-success @endif  @error('descripcion_capacidad') border-danger @enderror"
                    x-on:input="$wire.set('descripcion_capacidad', $('#descripcion_capacidad').val());"
                    placeholder="Ingrese la descripcion" autocomplete="off">
                </textarea>
                @error('descripcion_capacidad')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
                @if (!$errors->get('descripcion_capacidad') && $this->descripcion_capacidad != null)
                    <span class="flex text-success">Campo correcto</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-end">
                <button id="cancelarCapacidad" name="cancelarCapacidad" type="button" class="btn btn-danger">
                    <i class="fas fa-eraser"></i> Cancelar
                </button>
            </div>
            <div class="col d-flex justify-content-start">
                <button type="submit" class="btn btn-success" @if ($this->nombre_capacidad == '' || $this->descripcion_capacidad == '') disabled @endif>
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </form>
</div>
<script>
    // In your Javascript (external .js resource or <script> tag)
    document.addEventListener("DOMContentLoaded", function() {
        function editarCapacidad() {
            Sweetalert2.fire({
                title: 'Modo Edición',
                text: '¿Desea editar la capacidad seleccionada?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, editar',
                cancelButtonText: 'No, salir',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    editandoCapacidad();
                    @this.editar();
                }
            })
        }

        $('#cancelarCapacidad').on('click', function() {
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
                    cancelarCapacidad();
                    @this.clear();
                }
            })
        });

        $('#cancelar-btn-capacidad').on('click', function() {
            Sweetalert2.fire({
                title: 'Cancelar Edición',
                text: '¿Desea cancelar la edición de la capacidad seleccionada?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, cancelar',
                cancelButtonText: 'No, salir',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    cancelarCapacidad();
                    @this.clear();
                }
            })
        });

        function cancelarCapacidad() {
            $('#edit-btn-capacidad').removeAttr('hidden');
            $('#cancelar-btn-capacidad').attr('hidden', true);
            $('#capacidad_seleccionada').attr('disabled', false);
        }

        function editandoCapacidad() {
            $('#edit-btn-capacidad').attr('hidden', true);
            $('#cancelar-btn-capacidad').removeAttr('hidden');
            $('#capacidad_seleccionada').attr('disabled', true);
        }

        $('#edit-btn-capacidad').on('click', function() {
            if ($('#capacidad_seleccionada').val() != '') {
                editarCapacidad();
            } else {
                Sweetalert2.fire({
                    title: 'Capacidad no seleccionadA',
                    text: 'Seleccione una capacidad para editar',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                })
            }
        });

        $('#capacidad_seleccionada').select2({
            placeholder: 'Seleccione una opción',
            width: 'resolve',
        }).on('change', function() {
            @this.set('capacidad_seleccionada', $('#capacidad_seleccionada').val());
            if (@this.editando == true) {
                cancelarCapacidad();
                @this.clear();
            }
        });

        Livewire.on('limpiar-formulario-capacidad', function(permisos) {
            $('#nombre_capacidad').val(permisos[0]);
            $('#descripcion_capacidad').val(permisos[1]);
            $('#capacidad_seleccionada').val(permisos[2]).trigger('change');
        });

        Livewire.on('success-capacidad', function(message) {
            Sweetalert2.fire({
                title: 'Capacidad Guardada',
                text: message[0],
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false
            }).then((result) => {
                //window.location.reload();
                $('#capacidad_seleccionada').select2('destroy');
                $('#capacidad_seleccionada').empty();
                @this.getCapacidades().then(function(result) {
                        /* manejar un resultado exitoso */
                        // Transformar result a array
                        result_capacidades = Object.values(result);

                        let capacidades = [];
                        capacidades.push({
                            id: null,
                            text: 'Seleccione una opción',
                            selected: true,
                            disabled: false,
                        });

                        for (let i = 0; i < result_capacidades.length; i++) {
                            // Cargar en capacidades los atributos id y text que referencian a id y name del rol en result_capacidades[i]
                            capacidades.push({
                                id: result_capacidades[i].id,
                                text: result_capacidades[i].nombre
                            });
                        } 

                        // Ordenar por campo id dejando el id null al inicio
                        capacidades.sort((a, b) => a.id - b.id); 

                        $('#capacidad_seleccionada').select2({
                            placeholder: 'Seleccione una opción',
                            width: 'resolve',
                            data: capacidades
                        });
                        $('#capacidad_seleccionada').on('change', function() {
                            @this.set('capacidad_seleccionada', $('#capacidad_seleccionada')
                                .val());
                            if (@this.editando == true) {
                                cancelar();
                                @this.clear();
                            }
                        });
                        cancelar();
                        @this.clear();
                    },
                    function(error) {
                        /* manejar un error */
                        // mensaje de error en sweetalert2
                        Sweetalert2.fire({
                            title: 'Error',
                            text: 'Error al cargar los capacidades y permisos',
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

        Livewire.on('error-capacidad', function(message) {
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
