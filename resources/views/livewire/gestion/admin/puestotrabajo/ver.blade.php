<div>
    <style>
        /* Estilos para la tabla dentro del modal */
        div#element2pdf {
            background-color: white;
            color: black;
        }

        div#element2pdf>table {
            width: 100%;
            border: 1px solid black;
            /* Para que las líneas de las celdas no se dupliquen */
        }

        /* Estilos para las celdas de la tabla dentro del modal */
        div#element2pdf>table>tbody>tr>th,
        div#element2pdf>table>tbody>tr>td,
        div#element2pdf>table>thead>tr>th {
            border: 1px solid black;
        }
    </style>
    <div wire:ignore.self class="modal fade" id="modal-vista-trabajo" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Vista previa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        x-on:click="$wire.clear()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div id="element2pdf" class="modal-body">
                    @if ($puestoTrabajo != null)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="4">{{ $empresa->nombre }}</th>
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
                                    <th scope="row" width="20%">Sueldo base:</th>
                                    <td colspan="3">$ {{ $puestoTrabajo->sueldo_base }} (ARS)</td>
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
                                <tr style="page-break-before: always;">
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
                                                            <li>
                                                                {{ $capacidad->nombre . ': ' . $capacidad->descripcion }}
                                                                @if ($capacidad->pivot->excluyente)
                                                                    <span class="badge badge-danger"
                                                                        style="color: white; background-color: red">Excluyente</span>
                                                                @endif
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
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        x-on:click="$wire.clear()">Regresar</button>
                    <button id="descargar-pdf-btn" type="button" class="btn btn-secondary"
                        @if ($puestoTrabajo == null) disabled @endif><i class="fas fa-file-pdf"></i>Guardar
                        PDF</button>
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
                    // margin top, left, bottom, right
                    margin: [25, 10, 25, 10],
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

                const nombre_empresa = '{{ $empresa->nombre }}';
                const razon_social = '{{ $empresa->razon_social }}';
                const cuit = '{{ $empresa->cuit }}';
                const ubicacion = '{{ $empresa->ubicacion }}';
                const anio_inicio = '{{ $anio_inicio }}';

                // New Promise-based usage:
                // Genera el PDF con el pie de página y fecha/hora
                html2pdf().set(opt).from(element).toPdf().get('pdf').then(function(pdf) {
                    // Calcula la cantidad de páginas
                    const totalPages = pdf.internal.getNumberOfPages();
                    // Agrega la fecha y hora en la parte superior derecha
                    const fechaHora = new Date().toLocaleString();

                    // Agrega el encabezado en la primera página
                    pdf.setPage(1);
                    pdf.setFontSize(15);
                    pdf.text("Reporte de Puesto de Trabajo", pdf.internal
                        .pageSize
                        .getWidth() /
                        2, 10, {
                            align: 'center'
                        });
                    pdf.setFontSize(8);
                    pdf.text("Empresa:", 10, 15);
                    pdf.text(`${nombre_empresa}`, 40, 15);
                    pdf.text("Razón Social:", 10, 20);
                    pdf.text(`${razon_social}`, 40, 20);
                    pdf.text("CUIT:", 10, 25);
                    pdf.text(`${cuit}`, 40, 25);


                    pdf.text("Período:", pdf.internal.pageSize.getWidth() - 70, 15);
                    pdf.text(`${anio_inicio}` + " - " + new Date().getFullYear(), pdf.internal
                        .pageSize.getWidth() -
                        40, 15);
                    pdf.text("Ubicación:", pdf.internal.pageSize.getWidth() - 70, 20);
                    pdf.text(`${ubicacion}`, pdf.internal.pageSize.getWidth() - 40, 20);
                    pdf.text("Fecha y hora:", pdf.internal.pageSize.getWidth() - 70, 25);
                    pdf.text(`${fechaHora}`, pdf.internal.pageSize.getWidth() - 40, 25);

                    // Agrega el pie de página centrado en la parte inferior
                    pdf.setFontSize(10);
                    pdf.setPage(1);
                    pdf.text(`Página ${1} de ${totalPages}`, pdf.internal.pageSize.getWidth() /
                        2, pdf.internal.pageSize.getHeight() - 10, {
                            align: 'center'
                        });

                    // Itera sobre cada página para agregar el número de página
                    for (let i = 2; i <= totalPages; i++) {
                        pdf.setPage(i);
                        pdf.text(`Página ${i} de ${totalPages}`, pdf.internal.pageSize.getWidth() /
                            2, pdf.internal.pageSize.getHeight() - 10, {
                                align: 'center'
                            });
                    }
                }).save();

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
</div>
