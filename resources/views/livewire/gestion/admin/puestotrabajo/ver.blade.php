<div>
    <div wire:ignore.self class="modal fade" id="modal-vista-trabajo" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Vista previa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Regresar</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Descargar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
