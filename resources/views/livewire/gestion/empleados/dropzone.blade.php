<!-- DOCUMENTOS PREOCUPACIONALES -->
<div class="mb-3">
    <label for="dropzone-input">Documentos</label>
    <span class="d-tooltip parpadea" data-toggle="tooltip" data-placement="top"
        title="Documentos requeridos para el alta en AFIP y apertura de legajo">*</span>
    <input id="dropzone-input" class="d-none" wire:model="archivos" type="file"
        accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" multiple>
    <div id="dropzone"
        class="rounded mt-2 mb-4 p-5 text-center justify-content-center align-items-center"
        style="cursor: pointer; border: 1px solid #3d3d3d;">
        @if ($archivos)
            @foreach ($archivos as $archivo)
                <div class="d-flex justify-content-start align-items-center">
                    <div class="d-flex flex-column align-items-start">

                        <div data-toggle="tooltip" data-placement="bottom"
                            title="{{ $archivo->getClientOriginalName() }}">

                            <div class="d-flex justify-content-center align-items-center">
                                <div class="position-absolute"
                                    onclick="event.stopPropagation();"
                                    wire:click="eliminarArchivo('{{ $archivo->getClientOriginalName() }}')">
                                    <i class="fas fa-trash eliminar_item"></i>
                                </div>
                                @if ($archivo->guessExtension() == 'pdf')
                                    <img src="{{ asset('img/pdf.png') }}" alt=""
                                        class="img-fluid" width="100">
                                @elseif ($archivo->guessExtension() == 'docx' || $archivo->guessExtension() == 'doc')
                                    <img src="{{ asset('img/word.png') }}" alt=""
                                        class="img-fluid" width="100">
                                @else
                                    <img src="{{ $archivo->temporaryUrl() }}"
                                        alt="" class="img-fluid" width="100">
                                @endif
                            </div>


                            <div class="d-block text-truncate" style="max-width: 100px;">
                                {{ $archivo->getClientOriginalName() }}
                            </div>
                        </div>
                    </div>
                    <div onclick="event.stopPropagation();">
                        <select name="tipo_documento{{ $loop->index }}"
                            id="tipo_documento{{ $loop->index }}"
                            class="form-control select2 tipo_documento"
                            aria-placeholder="Seleccione una opción">
                            <option selected value="">Seleccione una opcion</option>
                            @foreach ($tipos_documentos as $tipo_documento)
                                <option value="{{ $tipo_documento['id'] }}">
                                    {{ strtoupper($tipo_documento['nombre']) }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            @endforeach
        @else
            @if (empty($archivos) && $errors->get('archivos.*'))
                <div class="text-danger font-italic" id="dropzone-none">
                    ERROR: Debe subir al menos un archivo válido.
                </div>
            @else
                <div class="text-secondary font-italic" id="dropzone-none">
                    Seleccione o arrastre los archivos en esta sección.
                </div>
            @endif
        @endif
    </div>

</div>
<script>
     document.addEventListener("DOMContentLoaded", function() {
        $('#dropzone').on('dragover', function(e) {
            // Deshabilitar la accion por defecto al dropear un archivo
            e.preventDefault();
            $(this).css('border', '1px dashed #3d3d3d');
        });

        $('#dropzone').on('dragleave', function(e) {
            // Deshabilitar la accion por defecto al dropear un archivo
            e.preventDefault();
            $(this).css('border', '1px solid #3d3d3d');
        });

        $('#dropzone').on('drop', function(e) {
            e.preventDefault();

            $(this).css('border', '1px solid #3d3d3d');

            // Obtener los archivos del evento drop
            const files = e.originalEvent.dataTransfer.files;

            // Asignar los archivos al input hidden
            const fileInput = document.getElementById('dropzone-input');
            const dataTransfer = new DataTransfer();
            Array.from(files).forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;

            // Disparar el evento change para que Livewire procese los archivos
            fileInput.dispatchEvent(new Event('change'));


        });

        $('#dropzone').on('click', function() {
            $('#dropzone-input').click();
        });
    });
</script>