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
                    <div class="col mb-2">
                        <label for="vista_nombre">Nombre</label>
                        <input type="text" name="vista_nombre" id="vista_nombre" class="form-control" disabled
                            value="{{ $this->vista_nombre }}">
                    </div>
                    <div class="col mb-2">
                        <label for="descripcion_vista">Descripción</label>
                        <textarea name="descripcion_vista" id="descripcion_vista" class="form-control" disabled>{{ $this->vista_descripcion }}</textarea>
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
                <label for="rol_seleccionado">Roles</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <select name="rol_seleccionado" id="rol_seleccionado" class="form-control select2"
                    name="state" aria-placeholder="Seleccione una opción">
                    <option value="" selected>Seleccione una opción</option>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($this->editando == true && $this->rol_seleccionado != null)
                <span class="flex text-warning parpadea"><strong>Editando</strong></span>
            @endif
        </div>
        <div wire:ignore class="row mx-2">
            <div class="mr-1">
                <label for="edit-btn">Editar</label>
                <span class="o-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Acción para editar el rol selecccionado">?</span>
                <br>
                <button name="edit-btn" id="edit-btn" class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                </button>
                <button hidden name="cancelar-btn" id="cancelar-btn" class="btn btn-danger">
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
    <form wire:submit.prevent="guardarRol">
        <div class="row mb-3">
            <div class="col">
                <label for="name">Nombre</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <input wire:model="name" type="text" name="name" id="name"
                    class="form-control @if (!$errors->get('') && $this->name != null) border-success @endif  @error('name') border-danger @enderror"
                    x-on:input="$wire.set('name', $('#name').val());" placeholder="Ingrese el nombre"
                    autocomplete="off">
                @error('name')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
                @if (!$errors->get('name') && $this->name != null)
                    <span class="flex text-success">Campo correcto</span>
                @endif
            </div>
        </div>
        <div class="mb-3">
            <div wire:ignore>
                <label for="selected_permissions">Permisos</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <select name="selected_permissions" id="selected_permissions" multiple="multiple"
                    class="form-control select2" name="selected_permissions"
                    aria-placeholder="Seleccione una opción">
                    @foreach ($permisos as $permiso)
                        <option value="{{ $permiso->id }}">{{ $permiso->name }}</option>
                    @endforeach
                </select>
            </div>
            @if (empty($this->permisos_seleccionados))
                <span class="error text-danger">Debe seleccionar al menos un permiso.</span>
            @else
                <span class="flex text-success">Campo correcto</span>
            @endif
        </div>
        <div class="row">
            <div class="col d-flex justify-content-end">
                <button id="cancelar" name="cancelar" type="button" class="btn btn-danger">
                    <i class="fas fa-eraser"></i> Cancelar
                </button>
            </div>
            <div class="col d-flex justify-content-start">
                <button type="submit" class="btn btn-success" @if (empty($this->permisos_seleccionados) || $errors->has('name')) disabled @endif>
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </form>
</div>
<script>
    // In your Javascript (external .js resource or <script> tag)
    document.addEventListener("DOMContentLoaded", function() {
        function editar() {
            Sweetalert2.fire({
                title: 'Modo Edición',
                text: '¿Desea editar el rol seleccionado?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, editar',
                cancelButtonText: 'No, salir',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    editando();
                    @this.editar();
                }
            })
        }

        $('#cancelar').on('click', function() {
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
                    cancelar();
                    @this.clear();
                }
            })
        });

        $('#cancelar-btn').on('click', function() {
            Sweetalert2.fire({
                title: 'Cancelar Edición',
                text: '¿Desea cancelar la edición del rol seleccionado?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, cancelar',
                cancelButtonText: 'No, salir',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    cancelar();
                    @this.clear();
                }
            })
        });

        function cancelar() {
            $('#edit-btn').removeAttr('hidden');
            $('#cancelar-btn').attr('hidden', true);
            $('#rol_seleccionado').attr('disabled', false);
        }

        function editando() {
            $('#edit-btn').attr('hidden', true);
            $('#cancelar-btn').removeAttr('hidden');
            $('#rol_seleccionado').attr('disabled', true);
        }

        $('#edit-btn').on('click', function() {
            if ($('#rol_seleccionado').val() != '') {
                editar();
            } else {
                Sweetalert2.fire({
                    title: 'Rol no seleccionado',
                    text: 'Seleccione un rol para editar',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                })
            }
        });

        $('#selected_permissions').select2({
            placeholder: 'Seleccione una opción',
            width: 'resolve'
        });
        $('#selected_permissions').on('change', function() {
            @this.set('permisos_seleccionados', $('#selected_permissions').val());
        });

        $('#rol_seleccionado').select2({
            placeholder: 'Seleccione una opción',
            width: 'resolve'
        });
        $('#rol_seleccionado').on('change', function() {
            @this.set('rol_seleccionado', $('#rol_seleccionado').val());
            if (@this.editando == true) {
                cancelar();
                @this.clear();
            }
        });

        Livewire.on('seleccionar-permisos', function(permisos) {
            $('#selected_permissions').val(permisos[0]).trigger('change');
        });

        Livewire.on('limpiar-formulario', function(permisos) {
            console.log("limpiando formulario");
            $('#rol_seleccionado').val(permisos[2]).trigger('change');
            $('#name').val(permisos[1]);
            $('#selected_permissions').val(permisos[0]).trigger('change');
        });

        Livewire.on('success', function(message) {
            Sweetalert2.fire({
                title: 'Rol Guardado',
                text: message[0],
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false
            }).then((result) => {
                //window.location.reload(); 
                $('#rol_seleccionado').select2('destroy');
                $('#rol_seleccionado').empty();
                @this.getRoles().then(function(result) {
                        /* manejar un resultado exitoso */
                        // Transformar result a array
                        result_roles = Object.values(result);

                        let roles = [];
                        roles.push({
                            id: null,
                            text: 'Seleccione una opción',
                            selected: true,
                            disabled: false,
                        });

                        for (let i = 0; i < result_roles.length; i++) {
                            // Cargar en roles los atributos id y text que referencian a id y name del rol en result_roles[i]
                            roles.push({
                                id: result_roles[i].id,
                                text: result_roles[i].name
                            });
                        } 

                        // Ordenar por campo id dejando el id null al inicio
                        roles.sort((a, b) => a.id - b.id); 

                        $('#rol_seleccionado').select2({
                            placeholder: 'Seleccione una opción',
                            width: 'resolve',
                            data: roles
                        });
                        $('#rol_seleccionado').on('change', function() {
                            @this.set('rol_seleccionado', $('#rol_seleccionado')
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
                            text: 'Error al cargar los roles y permisos',
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

        Livewire.on('error', function(message) {
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
