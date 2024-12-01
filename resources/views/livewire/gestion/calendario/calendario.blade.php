<div>
    <div class="card card-primary">
        <div class="card-header">
            <h4 class="card-title">Calendario de eventos</h4>
        </div>
        <div class="card-body p-0">
            <div id="calendar" wire:ignore></div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modal_eventos" tabindex="-1" role="dialog"
        aria-labelledby="modal_eventos_titulo" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_eventos_titulo">Gestion de Eventos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="cerrarModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="col text-left">
                            @hasanyrole('SYSADMIN|DIRECTOR GENERAL|JEFE AREA')
                                <div class="mb-3">
                                    <div wire:ignore>
                                        <label class="text-sm" for="grupo">Grupo de acceso</label>
                                        <span class="d-tooltip parpadea text-sm" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <select wire:model="grupo" type="text" id="grupo"
                                            class="form-control select2" placeholder="Grupo" autocomplete="off">
                                            <option value="" selected>Seleccione una opción</option>
                                            @foreach ($grupos_acceso as $grupo)
                                                <option value="{{ $grupo['id'] }}">{{ $grupo['nombre'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('grupo')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('grupo') && $this->grupo != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                            @endhasanyrole
                            @hasanyrole('EMPLEADO')
                                <div class="mb-3">
                                    <div wire:ignore>
                                        <label class="text-sm" for="grupo">Grupo de acceso</label>
                                        <span class="d-tooltip parpadea text-sm" data-toggle="tooltip" data-placement="top"
                                            title="Campo obligatorio">*</span>
                                        <input wire:model="grupo" type="text" id="grupo_aux" class="form-control"
                                            placeholder="PRIVADO" autocomplete="off" value="{{ auth()->user()->id }}"
                                            readonly>
                                    </div>
                                    @error('grupo')
                                        <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if (!$errors->get('grupo') && $this->grupo != null)
                                        <span class="d-block text-success valid-feedback">Campo correcto</span>
                                    @endif
                                </div>
                            @endhasanyrole
                            <div class="mb-3">
                                <label class="text-sm" for="titulo">Titulo del Evento</label>
                                <span class="d-tooltip parpadea text-sm" data-toggle="tooltip" data-placement="top"
                                    title="Campo obligatorio">*</span>
                                <input wire:model="titulo" type="text" id="titulo" class="form-control"
                                    placeholder="Título" autocomplete="off"
                                    x-on:input="$wire.set('titulo', $('#titulo').val())">
                                @error('titulo')
                                    <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                @enderror
                                @if (!$errors->get('titulo') && $this->titulo != null)
                                    <span class="d-block text-success valid-feedback">Campo correcto</span>
                                @endif
                            </div>


                            <div class="mb-3">
                                <div wire:ignore>
                                    <label class="text-sm" for="fecha_inicio">Fecha de Inicio del Evento</label>
                                    <span class="d-tooltip parpadea text-sm" data-toggle="tooltip" data-placement="top"
                                        title="Campo obligatorio">*</span>
                                    <input wire:model="fecha_inicio" type="date" id="fecha_inicio"
                                        class="form-control flatpickr" placeholder="Fecha de inicio" autocomplete="off">
                                </div>
                                @error('fecha_inicio')
                                    <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                @enderror
                                @if (!$errors->get('fecha_inicio') && $this->fecha_inicio != null)
                                    <span class="d-block text-success valid-feedback">Campo correcto</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <div wire:ignore>
                                    <label class="text-sm" for="fecha_fin">Fecha de Finalizacion del Evento</label>
                                    <span class="d-tooltip parpadea text-sm" data-toggle="tooltip" data-placement="top"
                                        title="Campo obligatorio">*</span>
                                    <input wire:model="fecha_fin" type="date" id="fecha_fin"
                                        class="form-control flatpickr" placeholder="Fecha de fin" autocomplete="off">
                                </div>
                                @error('fecha_fin')
                                    <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                @enderror
                                @if (!$errors->get('fecha_fin') && $this->fecha_fin != null)
                                    <span class="d-block text-success valid-feedback">Campo correcto</span>
                                @endif
                            </div>
 
                            {{-- <div class="mb-3">
                                <label class="text-sm" for="url">Enlace (URL) del Evento</label>
                                <span class="o-tooltip parpadea text-sm" data-toggle="tooltip" data-placement="top"
                                    title="Campo opcional">?</span>
                                <input wire:model="url" type="text" id="url" class="form-control"
                                    placeholder="Url" autocomplete="off"
                                    x-on:input="$wire.set('url', $('#url').val())">
                                error('url')
                                    <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                enderror
                                if (!$errors->get('url') && $this->url != null)
                                    <span class="d-block text-success valid-feedback">Campo correcto</span>
                                endif

                            </div>  --}}
                            
                            <div class="mb-3">
                                <label class="text-sm" for="color_picker">Color del Evento</label>
                                <span class="d-tooltip parpadea text-sm" data-toggle="tooltip" data-placement="top"
                                    title="Campo obligatorio">*</span>
                                <div class="input-group colorpicker-element" id="color_picker" name="color_picker">
                                    <input class="form-control" type="color" id="colorpicker" wire:model="color">
                                </div>
                                @error('color')
                                    <span class="d-block text-danger invalid-feedback">{{ $message }}</span>
                                @enderror
                                @if (!$errors->get('color') && $this->color != null)
                                    <span class="d-block text-success valid-feedback">Campo correcto</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="cerrarModal()">Cerrar</button>

                    @if ($editando)
                        <button id="btn-delete" type="button" class="btn btn-danger" onclick="eliminarEvento()">
                            <i class="fas fa-trash"></i>
                            Eliminar Evento</button>
                    @endif

                    <button id="btn-save" type="button" class="btn btn-primary" x-on:click="$wire.saveEvent()">
                        <i class="fas fa-save"></i>
                        Guardar Evento</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        window.getContrastTextColor = (hexColor) => {
            // Aseguramos el formato del color hexadecimal (e.g., "#FF00" -> "#FF0000")
            if (hexColor.length === 4) {
                hexColor =
                    `#${hexColor[1]}${hexColor[1]}${hexColor[2]}${hexColor[2]}${hexColor[3]}${hexColor[3]}`;
            }

            // Convertimos de hexadecimal a valores RGB
            const r = parseInt(hexColor.substring(1, 3), 16);
            const g = parseInt(hexColor.substring(3, 5), 16);
            const b = parseInt(hexColor.substring(5, 7), 16);

            // Calculamos la luminancia relativa según el estándar WCAG
            const luminance = 0.2126 * (r / 255) + 0.7152 * (g / 255) + 0.0722 * (b / 255);

            // Si la luminancia es alta, usamos texto negro; de lo contrario, blanco
            return luminance > 0.5 ? '#000000' : '#FFFFFF';
        }

        $("#colorpicker").on("change", function() {
            @this.set('color', $("#colorpicker").val())
        });

        window.eliminarEvento = () => {
            Sweetalert2.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar evento!',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
            }).then(result => {
                if (result.isConfirmed) {
                    @this.deleteEvent();
                }
            })
        }

        Livewire.on('success_refresh_table', () => {
            Sweetalert2.fire({
                title: 'Evento Guardado',
                text: 'El evento se ha guardado correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
            $('#modal_eventos').modal('hide')

            // Limpiar formulario
            $('#titulo').val('');
            $('#fecha_inicio').val('');
            $('#fecha_fin').val('');
            //$('#url').val('');
            $('#colorpicker').val('#000000'); // Color por defecto

            setTimeout(() => {
                cargarCalendario();
            }, 300);
        });

        Livewire.on('error', (params) => {
            Sweetalert2.fire({
                title: 'Error',
                text: 'Ha ocurrido un error: ' + params[0],
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        });

        $('#grupo').select2({
            placeholder: 'Seleccione una opción',
            width: '100%',
        }).on('change', function() {
            @this.set('grupo', $('#grupo').val());
        });


        window.cerrarModal = () => {
            $('#modal_eventos').modal('hide')
        }

        $('#modal_eventos').on('hidden.bs.modal', function() {
            $('#grupo').val('').trigger('change');
            $('#titulo').val('');
            $('#fecha_inicio').val('');
            $('#fecha_fin').val('');
            //$('#url').val('');
            $('#colorpicker').val('#000000'); // Color por defecto            
            @this.noEditar();
        });

        window.openSwallModal = () => {
            $('#modal_eventos').modal('show')

            setTimeout(() => {
                $("#fecha_inicio").flatpickr({
                    "locale": es.Spanish,
                    dateFormat: 'd-m-Y',
                    "minDate": new Date(new Date().setFullYear(new Date()
                        .getFullYear())),
                    "onChange": function() {
                        // Modificar
                        @this.set('fecha_inicio', $(
                            '#fecha_inicio').val());
                    },
                });
                $("#fecha_inicio").removeAttr('readonly')

                $("#fecha_fin").flatpickr({
                    "locale": es.Spanish,
                    dateFormat: 'd-m-Y',
                    "minDate": new Date(new Date().setFullYear(new Date()
                        .getFullYear())),
                    "onChange": function() {
                        // Modificar
                        @this.set('fecha_fin', $(
                            '#fecha_fin').val());
                    },
                });
                $("#fecha_fin").removeAttr('readonly')
            }, 300);
        };

        window.cargarCalendario = () => {
            calendar.removeAllEvents(); // Elimina los eventos actuales del calendario

            let eventos = @this.eventos; // Obtener los eventos originales

            // Crear un arreglo para almacenar los nuevos eventos generados
            // let nuevosEventos = [];

            // // Por cada evento, agregar textColor con la función getContrastTextColor
            // eventos.forEach(evento => {
            //     evento.textColor = getContrastTextColor(evento.color);

            //     // Comprobar si el título del evento incluye 'Cumpleaños'
            //     if (evento.title.includes('Cumpleaños') || evento.title.includes('Navidad')) {
            //         const fechaEvento = new Date(evento.start);

            //         // Generar los próximos 100 cumpleaños
            //         for (let i = 0; i < 100; i++) {
            //             const fechaCumple = new Date(fechaEvento);
            //             fechaCumple.setFullYear(fechaCumple.getFullYear() +
            //             i); // Incrementar el año

            //             nuevosEventos.push({
            //                 title: evento.title,
            //                 start: fechaCumple.toISOString().split('T')[0], // Solo la fecha
            //                 color: evento.color,
            //                 textColor: evento.textColor,
            //             });
            //         }
            //     }
            // });

            // // Combinar los eventos originales con los nuevos
            // eventos = [...eventos, ...nuevosEventos];

            // // Eliminar eventos repetidos el mismo dia
            // eventos = eventos.filter((evento, index, self) =>
            //     index === self.findIndex((t) => (
            //         t.start === evento.start
            //     ))
            // );

            // Añadir los eventos al calendario
            calendar.addEventSource(eventos);
        };

        var calendarEl = document.getElementById("calendar");

        window.calendar = new Calendar(calendarEl, {
            aspectRatio: 2,
            expandRows: true,
            plugins: [
                interactionPlugin,
                dayGridPlugin,
                timeGridPlugin,
                listPlugin,
                bootstrapPlugin,
            ],
            themeSystem: "bootstrap",
            locale: esLocale,
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
            },
            initialDate: new Date(),
            navLinks: true, // can click day/week names to navigate views
            dayMaxEvents: true, // allow "more" link when too many events
            events: [],
            eventClick: function(info) {
                
                let groupId;
                if (info.event.groupId != 999) {
                    groupId = "PRIVADO";
                } else {
                    groupId = "PUBLICO";
                }

                // Formatear la fecha de inicio
                let fecha_inicio = new Date(info.event.start).toLocaleDateString('es-ES');


                // Formatear la fecha de finalización (si existe)
                let fecha_fin = info.event.end ?
                    new Date(info.event.end).toLocaleDateString() :
                    'Sin fecha establecida'; // Manejar si `end` es null o undefined

                let owner = info.event._def.extendedProps.owner;
                
                Sweetalert2.fire({
                    title: info.event.title,
                    html: `
                        <b>Fecha de Inicio:</b> ${fecha_inicio}<br>
                        <b>Fecha de Finalización:</b> ${fecha_fin}<br>
                        <b>Grupo de Acceso:</b> ${groupId}<br>
                        <b>Dueño:</b> ${owner}<br>
                    `,
                    icon: 'info',
                    confirmButtonText: 'Editar',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    showCloseButton: true,
                    showLoaderOnConfirm: true,
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Editar evento
                        @this.editEvent(info.event.id);
                        Sweetalert2.close();
                    }
                }).catch((error) => {
                    console.error(error);
                });
            }
        });

        Livewire.on('edit_event', (params) => {
            // Abrir el modal
            params = params[0];
            console.log(params);

            openSwallModal();

            setTimeout(() => {
                // Asignar los valores del evento al formulario
                $('#titulo').val(params[1]).trigger('change');
                $("#fecha_inicio").val(params[2].toString()).trigger('change');
                $("#fecha_fin").val(params[3].toString()).trigger('change');
                // $('#url').val(params[4]).trigger('change');
                $('#colorpicker').val(params[4]).trigger('change');
                $('#grupo').val(params[5]).trigger('change');
            }, 500);
        });

        calendar.render();
        setTimeout(() => {
            calendar.updateSize();
            cargarCalendario();
        }, 300);

        $(document).on("click", '[data-widget="pushmenu"]', function(e) {
            // esperar a que se cierre el menu
            setTimeout(() => {
                calendar.updateSize();
            }, 300);
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
