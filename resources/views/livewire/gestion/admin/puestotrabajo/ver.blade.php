<div>
    <div wire:ignore.self class="modal fade" id="modal-vista-trabajo" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Vista previa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" x-on:click="$wire.clear()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div id="element2pdf" class="modal-body">
                    @if ($puestoTrabajo != null)
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th colspan="4">Morfeo S.A</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th width="20%">Título del puesto: </th>
                                    <td colspan="3">{{ $puestoTrabajo->titulo_puesto }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" width="20%">Descripción generica:</th>
                                    <td colspan="3">{{ $puestoTrabajo->descripcion_generica }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="4" width="20%">Descripción del puesto:</th>
                                </tr>
                                <tr>
                                    <td scope="row" colspan="4">
                                        @foreach ($tareas as $tarea)
                                            <ul>
                                                <li>{{ $tarea->nombre . ': ' . $tarea->descripcion }}</li>
                                            </ul>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="4" width="20%">Análisis del puesto:</th>
                                </tr>
                                @foreach ($tipos_capacidades as $tipo_capacidad)
                                    @if (in_array($tipo_capacidad->id, $tipos_capacidades_puesto))
                                        <tr>
                                            <td scope="row" colspan="4">
                                                <p>{{ $tipo_capacidad->nombre }}</p>
                                                @foreach ($capacidades as $capacidad)
                                                    @if ($capacidad->id_tipo_capacidad == $tipo_capacidad->id)
                                                        <ul>
                                                            <li>{{ $capacidad->nombre . ': ' . $capacidad->descripcion }}
                                                            </li>
                                                        </ul>
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" x-on:click="$wire.clear()">Regresar</button>
                    <button id="descargar-pdf-btn" type="button" class="btn btn-success" @if ($puestoTrabajo == null) disabled @endif>Descargar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#descargar-pdf-btn').click(function() {
                var element = document.getElementById('element2pdf');
                // if $puestoTrabajo->titulo_puesto != null then $puestoTrabajo->titulo_puesto en nombre

                var opt = {
                    margin: 10,
                    filename: 'MorfeoSA-PuestoTrabajo' + Date.now() + '.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 1
                    },
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'mm',
                        format: 'a4',
                        orientation: 'portrait'
                    }
                };

                // New Promise-based usage:
                // Genera el PDF con el pie de página y fecha/hora
                html2pdf().set(opt).from(element).toPdf().get('pdf').then(function(pdf) {
                    // Calcula la cantidad de páginas
                    const totalPages = pdf.internal.getNumberOfPages();

                    // Itera sobre cada página
                    for (let i = 1; i <= totalPages; i++) {
                        pdf.setPage(i);

                        // Agrega la fecha y hora en la parte superior derecha
                        const fechaHora = new Date().toLocaleString();
                        pdf.setFontSize(10);
                        pdf.text(`Morfeo S.A: Descripción de puesto de trabajo`, pdf.internal.pageSize.getWidth() + 10 -
                            pdf.internal.pageSize.getWidth(), 10); 
                        pdf.text(`Fecha y hora: ${fechaHora}`, pdf.internal.pageSize.getWidth() -
                            60, 10);

                        // Agrega el pie de página centrado en la parte inferior
                        pdf.setFontSize(10);
                        pdf.text(`Página ${i} de ${totalPages}`, pdf.internal.pageSize.getWidth() /
                            2, pdf.internal.pageSize.getHeight() - 10, {
                                align: 'center'
                            });
                    }
                }).save();

            });
        });
    </script>
</div>
