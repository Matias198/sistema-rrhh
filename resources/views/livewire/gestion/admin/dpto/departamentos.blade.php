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
                <label for="departamento_seleccionado">Departamento</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <select name="departamento_seleccionado" id="departamento_seleccionado" class="form-control select2"
                    aria-placeholder="Seleccione una opción">
                    <option selected value="">Seleccione una opcion</option>
                    @foreach ($departamentos as $departamento)
                        <option value="{{ $departamento->id }}">{{ strtoupper($departamento->nombre) }}</option>
                    @endforeach
                </select>
            </div>
            @if ($this->editando == true && $this->departamento_seleccionado != null)
                <span class="flex text-warning parpadea"><strong>Editando</strong></span>
            @endif
        </div>
        <div wire:ignore class="row mx-2">
            <div class="mr-1">
                <label for="edit-btn">Editar</label>
                <span class="o-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Acción para editar el departamento selecccionado">?</span>
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
                    data-target="#modal-vista-trabajo">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
    </div>
    <form wire:submit.prevent="guardar">
        <div class="row mb-3">
            <div class="col">
                <label for="nombre">Nombre</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <input wire:model="nombre" type="text" name="nombre" id="nombre"
                    class="form-control @if (!$errors->get('') && $this->nombre != null) border-success is-valid @endif  @error('nombre') border-danger is-invalid @enderror"
                    x-on:input="$wire.set('nombre', $('#nombre').val());" placeholder="Ingrese el nombre"
                    autocomplete="off">
                @error('nombre')
                    <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                @enderror
                @if (!$errors->get('nombre') && $this->nombre != null)
                    <span class="d-block text-success valid-feedback">Campo correcto</span>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="descripcion">Descripción</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <textarea wire:model="descripcion" type="text" name="descripcion" id="descripcion"
                    class="form-control @if (!$errors->get('') && $this->descripcion != null) border-success is-valid @endif  @error('descripcion') border-danger is-invalid @enderror"
                    x-on:input="$wire.set('descripcion', $('#descripcion').val());" placeholder="Ingrese la descripcion"
                    autocomplete="off">
                </textarea>
                @error('descripcion')
                    <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                @enderror
                @if (!$errors->get('descripcion') && $this->descripcion != null)
                    <span class="d-block text-success valid-feedback">Campo correcto</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-end">
                <button id="cancelar" name="cancelar" type="button" class="btn btn-danger">
                    <i class="fas fa-eraser"></i> Cancelar
                </button>
            </div>
            <div class="col d-flex justify-content-start">
                <button type="submit" class="btn btn-success" @if ($this->nombre == '' || $this->descripcion == '') disabled @endif>
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
                text: '¿Desea editar el departamento seleccionado?',
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
                text: '¿Desea cancelar la edición del departamento seleccionado?',
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
            $('#departamento_seleccionado').attr('disabled', false);
        }

        function editando() {
            $('#edit-btn').attr('hidden', true);
            $('#cancelar-btn').removeAttr('hidden');
            $('#departamento_seleccionado').attr('disabled', true);
        }

        $('#edit-btn').on('click', function() {
            if ($('#departamento_seleccionado').val() != '') {
                editar();
            } else {
                Sweetalert2.fire({
                    title: 'Departamento no seleccionado',
                    text: 'Seleccione un departamento para editar',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                })
            }
        });

        $('#departamento_seleccionado').select2({
            placeholder: 'Seleccione una opción',
            width: 'resolve',
        }).on('change', function() {
            @this.set('departamento_seleccionado', $('#departamento_seleccionado').val());
            if (@this.editando == true) {
                cancelar();
                @this.clear();
            }
        });

        Livewire.on('limpiar-formulario', function(params) {
            $('#nombre').val(params[0]);
            $('#descripcion').val(params[1]);
            $('#departamento_seleccionado').val(params[2]).trigger('change');
        });

        Livewire.on('success', function(message) {
            Sweetalert2.fire({
                title: 'Departamento Guardado',
                text: message[0],
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
                allowOutsideClick: false
            }).then((result) => {
                //window.location.reload();
                $('#departamento_seleccionado').select2('destroy');
                $('#departamento_seleccionado').empty();
                @this.getDepartamentos().then(function(result) {
                        /* manejar un resultado exitoso */
                        // Transformar result a array
                        result_departamentos = Object.values(result);

                        let departamentos = [];
                        departamentos.push({
                            id: null,
                            text: 'Seleccione una opción',
                            selected: true,
                            disabled: false,
                        });

                        for (let i = 0; i < result_departamentos.length; i++) {
                            // Cargar en departamentos los atributos id y text que referencian a id y name del rol en result_departamentos[i]
                            departamentos.push({
                                id: result_departamentos[i].id,
                                text: result_departamentos[i].nombre
                            });
                        }

                        // Ordenar por campo id dejando el id null al inicio
                        departamentos.sort((a, b) => a.id - b.id);

                        $('#departamento_seleccionado').select2({
                            placeholder: 'Seleccione una opción',
                            width: 'resolve',
                            data: departamentos
                        });
                        $('departamento_seleccionado').on('change', function() {
                            @this.set('departamento_seleccionado', $(
                                    '#departamento_seleccionado')
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
                            text: 'Error al cargar los departamentos',
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
