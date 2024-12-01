<div id="reporte_empleado_pdf">
    @if ($persona)
        @hasanyrole('DIRECTOR GENERAL|JEFE DE AREA|SYSADMIN')
            <div class="d-flex justify-content-end mb-3">
                <button id="descargar-pdf-btn" type="button" class="btn btn-secondary"
                    @if ($persona == null) disabled @endif>
                    <i class="fas fa-file-pdf"></i>
                    Guardar PDF</button>
            </div>
        @endhasanyrole

        <!-- DATOS PERSONALES -->

        <div class="card card-primary">
            <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                <h3 class="card-title">Datos Personales</h3>
                <div class="card-tools">
                    <a type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                    </a>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col">
                        <label for="nombre">Nombre</label>
                        <input readonly type="text" name="nombre" id="nombre" class="form-control"
                            value="{{ $persona->nombre }}" autocomplete="off">
                    </div>
                    @if ($persona->segundo_nombre)
                        <div class="col">
                            <label for="s_nombre">Segundo Nombre</label>
                            <input readonly type="text" name="s_nombre" id="s_nombre" class="form-control"
                                value="{{ $persona->segundo_nombre }}" autocomplete="off">
                        </div>
                    @endif
                    <div class="col">
                        <label for="apellido">Apellido</label>
                        <input readonly type="text" name="apellido" id="apellido" class="form-control"
                            value="{{ $persona->apellido }}" autocomplete="off">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="dni">DNI</label>
                        <input readonly type="text" name="dni" id="dni" class="form-control"
                            value="{{ $persona->dni }}" autocomplete="off">
                    </div>
                    <div class="col">
                        <label for="cuil">CUIL</label>
                        <input readonly type="text" name="cuil" id="cuil" class="form-control"
                            value="{{ $persona->cuil }}" placeholder="Ingrese el CUIL" autocomplete="off">
                    </div>

                    <div class="col">
                        <label for="legajo">Legajo</label>
                        <input readonly type="text" name="legajo" id="legajo" class="form-control"
                            value="{{ $persona->empleado->legajo }}" autocomplete="off">
                    </div>
                </div>
                <div class="row mb-3">

                    <div class="col">
                        <label for="sexo_selected">Sexo</label>
                        <input readonly type="text" name="sexo_selected" id="sexo_selected" class="form-control"
                            value="{{ $persona->sexo->nombre }}" autocomplete="off">
                    </div>
                    <div class="col">
                        <label for="estado_civil">Estado Civil</label>
                        <input readonly type="text" name="estado_civil" id="estado_civil" class="form-control"
                            value="{{ $persona->estadoCivil->nombre }}" autocomplete="off">
                    </div>
                    <div class="col">
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input readonly type="text" name="fecha_nacimiento" id="fecha_nacimiento"
                            class="form-control"
                            value="{{ Carbon\Carbon::parse($persona->fecha_nacimiento)->format('d-m-Y') }}"
                            autocomplete="off">
                    </div>
                </div>
            </div>
            <!-- /.card-body  style="display: none;"-->
        </div>

        <!-- DOMICILIO -->

        <div class="card card-primary collapsed-card mt-1" style="page-break-before: always;">
            <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                <h3 class="card-title">Domicilio</h3>
                <div class="card-tools">
                    <a type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                    </a>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: none;">
                <div class="row mb-3">
                    <div class="col">
                        <label for="pais">País</label>
                        <input readonly type="text" name="pais" id="pais" class="form-control"
                            value="{{ $persona->municipio()->first()->provincias()->first()->pais()->first()->nombre }}"
                            autocomplete="off">
                    </div>
                    <div class="col">
                        <label for="provincia">Provincia</label>
                        <input readonly type="text" name="provincia" id="provincia" class="form-control"
                            value="{{ $persona->municipio()->first()->provincias()->first()->nombre }}"
                            autocomplete="off">
                    </div>
                    <div class="col">
                        <label for="municipio">Municipio</label>
                        <input readonly type="text" name="municipio" id="municipio" class="form-control"
                            value="{{ $persona->municipio()->first()->nombre }}" autocomplete="off">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="calle">Calle</label>
                        <input readonly type="text" name="calle" id="calle" class="form-control"
                            value="{{ $persona->calle }}" autocomplete="off">
                    </div>
                    @if ($persona->altura != null)
                        <div class="col">
                            <label for="altura">Altura</label>
                            <input readonly type="text" name="altura" id="altura" class="form-control"
                                value="{{ $persona->altura }}" autocomplete="off">
                        </div>
                    @endif
                    @if ($persona->departamento != null)
                        <div class="col">
                            <label for="departamento">Departamento</label>
                            <input readonly type="text" name="departamento" id="departamento"
                                class="form-control" value="{{ $persona->departamento }}" autocomplete="off">
                        </div>
                    @endif
                </div>
            </div>
            <!-- /.card-body  style="display: none;"-->
        </div>

        <!-- FAMILIARES A CARGO -->
        @if ($persona->familiares()->get()->first())
            <div class="card card-primary collapsed-card mt-1" style="page-break-before: always;">
                <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                    <h3 class="card-title">Familiares a Cargo</h3>
                    <div class="card-tools">
                        <a type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                        </a>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: none;">
                    <div class="row mb-3">
                        <!-- Listado de familiares -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>DNI</th>
                                        <th>Fecha de Nacimiento</th>
                                        <th>Sexo</th>
                                        <th>Tipo de Relación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($persona->familiares()->get() as $familiar)
                                        <tr>
                                            <td>{{ $familiar->nombre }}</td>
                                            <td>{{ $familiar->apellido }}</td>
                                            <td>{{ $familiar->dni }}</td>
                                            <td>{{ $familiar->fecha_nacimiento }}</td>
                                            <td>{{ $familiar->sexo->nombre }}</td>
                                            <td>{{ $familiar->pivot->detalle }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body  style="display: none;"-->
            </div>
        @endif

        <!-- OBRA SOCIAL -->

        @if (!empty($persona->obrasSociales()->get()->first()))
            <div class="card card-primary collapsed-card mt-1" style="page-break-before: always;">
                <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                    <h3 class="card-title">Obra Social</h3>
                    <div class="card-tools">
                        <a type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                        </a>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: none;">
                    <div class="row mb-3">
                        <div class="col-9">
                            <label for="obra_social">Obra Social</label>
                            <input readonly type="text" name="obra_social" id="obra_social" class="form-control"
                                value="{{ $persona->obrasSociales()->get()[0]->nombre }}" autocomplete="off">
                        </div>
                        <div class="col">
                            <label for="numero_afiliado">Numero de Afiliado</label>
                            <input readonly type="text" name="numero_afiliado" id="numero_afiliado"
                                class="form-control"
                                value="{{ $persona->obrasSociales()->get()[0]->pivot->numero_afiliado }}"
                                autocomplete="off">
                        </div>
                    </div>
                </div>
                <!-- /.card-body  style="display: none;"-->
            </div>
        @endif


        <!-- CONTACTO Y CONTACTOS DE EMERGENCIA -->

        <div class="card card-primary collapsed-card mt-1" style="page-break-before: always;">
            <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                <h3 class="card-title">Información y Contactos de Emergencia</h3>
                <div class="card-tools">
                    <a type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                    </a>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: none;">
                <p>Informacion de contacto personal:</p>
                <div class="row mb-3">
                    <div class="col">
                        <label for="email">Email de uso Personal</label>
                        <input readonly type="text" name="email" id="email" class="form-control"
                            value="{{ $persona->usuario->email }}" autocomplete="off">
                    </div>

                    <div class="col"></div>
                    <div class="col"></div>

                </div>
                <p>Informacion de contactos de emergencia:</p>
                <div class="row mb-3">
                    <!-- Listado de contactos de emergencia -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Tipo de Relación</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($persona->contactosEmergencia()->get() as $contacto)
                                    <tr>
                                        <td>{{ $contacto->nombre }}</td>
                                        <td>{{ $contacto->apellido }}</td>
                                        <td>{{ $contacto->tipoRelacion->nombre }}</td>
                                        <td>{{ $contacto->telefono }}</td>
                                        <td>{{ $contacto->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card-body  style="display: none;"-->
        </div>

        <!-- DATOS DE EMPLEADO -->

        <div class="card card-primary collapsed-card mt-1" style="page-break-before: always;">
            <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                <h3 class="card-title">Datos del Puesto de Trabajo</h3>
                <div class="card-tools">
                    <a type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                    </a>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: none;">
                <div class="row mb-3">
                    <div class="col">
                        <label for="puesto_de_trabajo_selected">Puesto de Trabajo Afectado</label>
                        <input readonly type="text" name="puesto_de_trabajo_selected"
                            id="puesto_de_trabajo_selected" class="form-control"
                            value="{{ $persona->empleado->puesto->titulo_puesto }}" autocomplete="off">
                    </div>
                    <div class="col">
                        <label for="sueldo">Sueldo Basico</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">$</span>
                            </div>
                            <input readonly type="text" name="sueldo" id="sueldo" class="form-control"
                                value="{{ $persona->empleado->contrato->sueldo }}" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="hora_entrada">Hora de Entrada</label>
                        <input readonly type="text" name="hora_entrada" id="hora_entrada" class="form-control"
                            value="{{ $persona->empleado->contrato->hora_entrada }}" autocomplete="off">
                    </div>
                    @if ($persona->empleado->contrato->hora_inicio_receso && $persona->empleado->contrato->hora_fin_receso)
                        <div class="col">
                            <label for="hora_inicio_receso">Inicio de Receso</label>
                            <input readonly type="text" name="hora_inicio_receso" id="hora_salida"
                                class="form-control" value="{{ $persona->empleado->contrato->hora_inicio_receso }}"
                                autocomplete="off">
                        </div>
                        <div class="col">
                            <label for="hora_fin_receso">Fin de Receso</label>
                            <input readonly type="text" name="hora_fin_receso" id="hora_fin_receso"
                                class="form-control" value="{{ $persona->empleado->contrato->hora_fin_receso }}"
                                autocomplete="off">
                        </div>
                    @endif
                    <div class="col">
                        <label for="hora_salida">Hora de Salida</label>
                        <input readonly type="text" name="hora_salida" id="hora_salida" class="form-control"
                            value="{{ $persona->empleado->contrato->hora_salida }}" autocomplete="off">
                    </div>
                </div>
                <p>Información de ingreso al puesto de trabajo</p>
                <div class="row mb-3">
                    <div class="col">
                        <label for="fecha_ingreso">Fecha de Ingreso</label>
                        <input readonly type="text" name="fecha_ingreso" id="fecha_ingreso" class="form-control"
                            value="{{ Carbon\Carbon::parse($persona->empleado->contrato->fecha_ingreso)->format('d-m-Y') }}"
                            autocomplete="off">
                    </div>
                    @if ($persona->empleado->contrato->fecha_vencimiento)
                        <div class="col">
                            <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                            <input readonly type="text" name="fecha_vencimiento" id="fecha_vencimiento"
                                class="form-control"
                                value="{{ Carbon\Carbon::parse($persona->empleado->contrato->fecha_vencimiento)->format('d-m-Y') }}"
                                autocomplete="off">
                        </div>
                    @endif
                    <div class="col">
                        <label for="tipo_contratos_selected">Tipo de Contrato</label>
                        <input readonly type="text" name="tipo_contratos_selected" id="tipo_contratos_selected"
                            class="form-control" value="{{ $persona->empleado->contrato->tipoContrato->nombre }}"
                            autocomplete="off">
                    </div>
                    <div class="col">
                        <label for="tipo_jornadas_selected">Tipo de Jornada</label>
                        <input readonly type="text" name="tipo_jornadas_selected" id="tipo_jornadas_selected"
                            class="form-control" value="{{ $persona->empleado->contrato->tipoJornada->nombre }}"
                            autocomplete="off">
                    </div>
                </div>
            </div>
            <!-- /.card-body  style="display: none;"-->
        </div>

        <!-- CAPACIDADES DEL EMPLEADO -->

        <div class="card card-primary collapsed-card mt-1" style="page-break-before: always;">
            <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                <h3 class="card-title">Competencias Satisfactorias del Empleado</h3>
                <div class="card-tools">
                    <a type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                    </a>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: none;">

                @if (!empty($persona->empleado->competencias()->get()))
                    <p>Competencias que el empleado ofrece para cubrir el puesto de trabajo seleccionado:
                    </p>
                    @foreach ($persona->empleado->puesto->capacidadesTrabajos()->get() as $competencias_trabajo)
                        <div class="row mb-3">
                            <div class="col">
                                <div class="icheck-primary icheck-inline">
                                    <input disabled type="checkbox" id="cchb{{ $competencias_trabajo->id }}"
                                        name="cchb{{ $competencias_trabajo->id }}"
                                        value="{{ $competencias_trabajo->id }}"
                                        @if ($persona->empleado->competencias->contains($competencias_trabajo)) checked @endif>
                                    <label style="opacity: 1;"
                                        for="cchb{{ $competencias_trabajo->id }}">{{ $competencias_trabajo->nombre }}
                                        <span><small
                                                class="text-info">({{ $competencias_trabajo->tipoCapacidad->nombre }})</small></span>
                                        <p class="text-sm font-italic text-secondary">
                                            {{ $competencias_trabajo->descripcion }}</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                {{-- <a type="button" class="btn btn-secondary" x-on:click="$wire.getCompetencias()">Competencias</a> --}}
            </div>
            <!-- /.card-body  style="display: none;"-->
        </div>

        <!-- DOCUMENTACION DEL EMPLEADO -->

        <div class="card card-primary collapsed-card mt-1" style="page-break-before: always;">
            <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">
                <h3 class="card-title">Documentación del Empleado</h3>
                <div class="card-tools">
                    <a type="button" class="btn btn-tool"><i class="fas fa-square"></i>
                    </a>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: none;">
                <!-- Listado de documentacion con un boton de ver -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Fecha de Carga</th>
                                <th class="action_header">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($persona->documentosCertificados()->get() as $documento)
                                <tr>
                                    <td>{{ $documento->nombre_archivo }}</td>
                                    <td><span>{{ $documento->tipoDocumento->nombre }}</span></td>
                                    <td>
                                        @if ($documento->estado == 1)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Eliminado</span>
                                        @endif
                                    </td>
                                    <td>{{ $documento->created_at }}</td>

                                    @if ($documento->estado == 1)
                                        <td class="action_column">
                                            <a type="button" class="btn btn-primary"
                                                x-on:click="verArchivo([{{ $documento->id }}, '{{ $documento->detalle }}'])">Ver</a>
                                            @hasanyrole('DIRECTOR GENERAL|JEFE DE AREA|SYSADMIN')
                                                <a type="button" class="btn btn-success"
                                                    onclick="actualizarDocumento({{ $documento->id }}, '{{ $documento->tipoDocumento->nombre }}')">Actualizar</a>
                                            @endhasanyrole
                                        </td>
                                    @else
                                        <td>
                                            Baja registrada: {{ $documento->updated_at }}
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <input type="file" name="documento_file" hidden accept=".pdf,.doc,.docx,.png,.jpg,.jpeg"
            id="documento_file" class="form-control" wire:model="documento_file" placeholder="Ingrese el documento"
            autocomplete="off" x-on:change="mostrarNombreFile()">
    @else
        <div class="alert alert-warning" role="alert">
            <strong>¡Atención!</strong> No se ha encontrado información del empleado.
        </div>
    @endif
</div>
@hasanyrole('DIRECTOR GENERAL|JEFE DE AREA|SYSADMIN')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // export pdf card-body
        $('#descargar-pdf-btn').click(function() {
            var element = document.getElementById('reporte_empleado_pdf');
            // if $puestoTrabajo->titulo_puesto != null then $puestoTrabajo->titulo_puesto en nombre

            // Oculta el botón de descarga y muestra el contenido
            $('#descargar-pdf-btn').css('display', 'none');
            $('.card-body').css('display', 'block');
            $('.card-header').removeClass('collapsed-card');
            $('.card-header').addClass('expanded-card');
            $('.action_column').css('display', 'none');
            $('.action_header').css('display', 'none');

            var opt = {
                // margin top, left, bottom, right
                margin: [25, 10, 25, 10],
                filename: 'MorfeoSA-ReporteEmpleado' + Date.now() + '.pdf',
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
                pdf.text("Reporte de Empleado", pdf.internal
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
            }).save().then(function() {
                // Muestra el botón de descarga y oculta el contenido
                $('#descargar-pdf-btn').css('display', 'block');
                $('.card-body').css('display', 'none');
                $('.card-header').removeClass('expanded-card');
                $('.card-header').addClass('collapsed-card');
                $('.action_column').css('display', 'block');
                $('.action_header').css('display', 'block');
            });



        });
    });
</script>
@endhasanyrole
<script>
    document.addEventListener('DOMContentLoaded', function() {

        window.verArchivo = (params) => {
            @this.obtenerArchivo(params[0], params[1]).then((response) => {
                console.log(response)
                window.open(response, '_blank');
            });
        }

        Livewire.on('success-documento', function(message) {
            const ToastSuccess = Sweetalert2.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Sweetalert2.stopTimer;
                    toast.onmouseleave = Sweetalert2.resumeTimer;
                }
            });
            ToastSuccess.fire({
                icon: "success",
                title: message[0]
            });
        });

        window.mostrarNombreFile = function() {
            $('#guardarDoc').attr('hidden', false)
            $('#nombreFile').text($('#documento_file').val().split('\\').pop())
            $('#nombreFile').removeClass('text-danger').addClass('text-success')
        }

        window.actualizarDocumento = function(id, nombre) {
            Sweetalert2.fire({
                title: "Actualizar Documento",
                icon: "info",
                html: `
                <p>Seleccione el nuevo documento para actualizar el <strong>${nombre}</strong></p>
                <div class="d-flex justify-content-center mb-3">
                <a type="button" class="btn btn-primary mx-1" x-on:click="$('#documento_file').click()">
                    <i class="fas fa-upload"></i>
                    Subir Documento
                </a> 
                <a id="guardarDoc" hidden type="button" class="btn btn-success mx-1" x-on:click="@this.actualizarDocumento({{ $documento->id }})">
                    <i class="fas fa-save"></i>
                    Guardar Cambios
                </a>
                </div>
                <div class="d-flex justify-content-center font-italic"><span id="nombreFile" class="text-danger">Nigun archivo cargado.</span>
                </div>
                `,
                showCloseButton: true,
                showCancelButton: false,
                showConfirmButton: false,
            });
        }

        Livewire.on('error_critico', function(params) {
            const ToastError = Sweetalert2.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Sweetalert2.stopTimer;
                    toast.onmouseleave = Sweetalert2.resumeTimer;
                }
            });
            ToastError.fire({
                icon: "error",
                title: params[0]
            });
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
