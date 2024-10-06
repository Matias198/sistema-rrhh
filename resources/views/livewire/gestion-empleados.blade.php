<div>
    <form wire:submit.prevent="saveContact">
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
            <div class="col">
                <label for="s_nombre">Segundo Nombre</label>
                <span class="o-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo opcional">?</span>
                <input wire:model="s_nombre" type="text" name="s_nombre" id="s_nombre"
                    class="form-control @if (!$errors->get('') && $this->s_nombre != null) border-success @endif @error('s_nombre') border-danger @enderror"
                    x-on:input="$wire.setAttribute('s_nombre', $('#s_nombre').val());"
                    placeholder="Ingrese el segundo nombre" autocomplete="off">
                @error('s_nombre')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
                @if (!$errors->get('s_nombre') && $this->s_nombre != null)
                    <span class="flex text-success">Campo correcto</span>
                @endif
            </div>
            <div class="col">
                <label for="apellido">Apellido</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <input wire:model="apellido" type="text" name="apellido" id="apellido"
                    class="form-control @if (!$errors->get('') && $this->apellido != null) border-success @endif @error('apellido') border-danger @enderror"
                    x-on:input="$wire.setAttribute('apellido', $('#apellido').val());" placeholder="Ingrese el apellido"
                    autocomplete="off">
                @error('apellido')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
                @if (!$errors->get('apellido') && $this->apellido != null)
                    <span class="flex text-success">Campo correcto</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div wire:ignore>
                    <label for="sexo">Sexo</label>
                    <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                        title="Campo obligatorio">*</span>
                    <select name="sexo" id="sexo" class="form-control select2" name="state"
                        aria-placeholder="Seleccione una opción">
                        <option selected value="">Seleccione una opcion</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </select>
                </div>
                @error('sexo')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
                @if (!$errors->get('sexo') && $this->sexo != null)
                    <span class="flex text-success">Campo correcto</span>
                @endif
            </div>
            <div class="col">
                <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
                    title="Campo obligatorio">*</span>
                <input name="fecha_nacimiento" id="fecha_nacimiento" class="flatpickr form-control"
                    placeholder="Seleccione la fecha de nacimiento">
                @error('fecha_nacimiento')
                    <span class="error text-danger">{{ $message }}</span>
                @enderror
                @if (!$errors->get('fecha_nacimiento') && $this->fecha_nacimiento != null)
                    <span class="flex text-success">Campo correcto</span>
                @endif
            </div>
        </div>
        <!--<button type="submit">Save Contact</button>-->
    </form>
</div>
<script>
    // In your Javascript (external .js resource or <script> tag)
    document.addEventListener("DOMContentLoaded", function() {
        $('.select2').select2({
            placeholder: 'Seleccione una opción',
            width: 'resolve',
        }).on('change', function() {
            // Modificar
            @this.set('sexo', $('#sexo').val());
        });
        $('.select2.select2-container.select2-container--default').css('width', '100%')
        $(".flatpickr").flatpickr({
            "locale": es.Spanish,
            dateFormat: 'd-m-Y',
            "minDate": new Date(new Date().setFullYear(new Date().getFullYear() - 120)),
            "maxDate": new Date(new Date().setFullYear(new Date().getFullYear() - 16)),
            "onChange": function() {
                // Modificar
                @this.set('fecha_nacimiento', $('#fecha_nacimiento').val());
                //@this.getAttribute('fecha_nacimiento').then((result)=>console.log(result))
            },
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
