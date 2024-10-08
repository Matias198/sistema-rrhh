<div>
    <div class="row mb-3">
        <div class="col">
            <div wire:ignore>
                <label for="rol_seleccionado">Roles</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <select name="rol_seleccionado" id="rol_seleccionado" class="form-control select2 role-select2" name="state"
                    aria-placeholder="Seleccione una opción">
                    <option selected value="">Seleccione una opcion</option>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}">{{ strtoupper($rol->name) }}</option>
                    @endforeach
                </select>
            </div>
            @if ($this->editando == true && $this->rol_seleccionado != null)
                <span class="flex text-warning parpadea"><strong>Editando</strong></span>
            @endif
        </div>
        <div wire:ignore class="col">
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
    </div>
    <form wire:submit.prevent="guardarRol">
        <div class="row mb-3">
            <div class="col">
                <label for="name">Nombre</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <input wire:model="name" type="text" name="name" id="name"
                    class="form-control @if (!$errors->get('') && $this->name != null) border-success @endif  @error('name') border-danger @enderror"
                    x-on:input="$wire.setAttribute('name', $('#name').val());" placeholder="Ingrese el nombre"
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
                <select name="selected_permissions" id="selected_permissions" multiple
                    class="form-control select2 permissions-select2" name="state"
                    aria-placeholder="Seleccione una opción">
                    @foreach ($permisos as $permiso)
                        <option value="{{ $permiso->id }}">{{ strtoupper($permiso->name) }}</option>
                    @endforeach
                </select>
            </div>
            @if(empty($this->permisos_seleccionados))
                <span class="error text-danger">Debe seleccionar al menos un permiso.</span>
            @else
                <span class="flex text-success">Campo correcto</span>
            @endif
        </div>
        <div class="row">
            <div class="col d-flex justify-content-end">
                <button id="cancelar" name="cancelar" type="button" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Cancelar
                </button>
            </div>
            <div class="col d-flex justify-content-start">
                <button type="submit" class="btn btn-success" @if(empty($this->permisos_seleccionados)) disabled @endif>
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
        }

        function editando() {
            $('#edit-btn').attr('hidden', true);
            $('#cancelar-btn').removeAttr('hidden');
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

        $('.role-select2').select2({
            placeholder: 'Seleccione una opción',
            width: 'resolve',
        }).on('change', function() {
            @this.set('rol_seleccionado', $('#rol_seleccionado').val());
        });

        $('.permissions-select2').select2({
            placeholder: 'Seleccione una opción',
            width: 'resolve',
        }).on('change', function() {
            @this.set('permisos_seleccionados', $('#selected_permissions').val()); 
        });

        Livewire.on('seleccionar-permisos', function(permisos) {
            $('.permissions-select2').val(permisos[0]).trigger('change');
        });

        Livewire.on('limpiar-formulario', function(permisos) {
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
                window.location.reload();
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
