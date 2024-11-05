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
                    x-on:input="$wire.set('descripcion_puesto', $('#descripcion_puesto').val());" placeholder="Ingrese una descripción genérica"
                    autocomplete="off">
                </textarea>
                @error('descripcion_puesto')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
                @if (!$errors->get('descripcion_puesto') && $this->descripcion_puesto != null)
                    <span class="flex text-success">Campo correcto</span>
                @endif
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

            Livewire.on('success_tarea', () => {
                // recargar las tareas guardadas con el metodo de livewire
            });
        });
    </script>
</div>
