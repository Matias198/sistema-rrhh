import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";// For dateClick
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import bootstrapPlugin from "@fullcalendar/bootstrap";
import esLocale from "@fullcalendar/core/locales/es";
import axios from 'axios';
 
//import swal from 'sweetalert2';
//window.Swal = swal;

//import 'bootstrap/dist/css/bootstrap.css';
//var myModal = new bootstrap.Modal(document.getElementById('myModal'));
import "bootstrap-icons/font/bootstrap-icons.css"; // webpack uses file-loader to handle font files
import { star } from "fontawesome";
import { end } from "@popperjs/core";

document.addEventListener('DOMContentLoaded', async  function () {
    var calendarEl = document.getElementById('agenda');
    var calendar = new Calendar(calendarEl, {
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
        navLinks: true, // permite navegar en las vistas de dias y semanas
        dayMaxEvents:true,
        editable: true, // Habilitar edición
        droppable: true, // Habilitar arrastrar y soltar
        selectable:true,
        //events: '/api/eventos', // Load events from the API
        events: function (fetchInfo, successCallback, failureCallback) {
            // Solicitud del Get Axios para recuperar los eventos
            axios
                .get('/api/eventos', {
                    params: {
                        start: fetchInfo.startStr, // Proporcionado por FullCalendar
                        end: fetchInfo.endStr,   // Proporcionado por FullCalendar
                    }
                })
                .then(response => {
                    successCallback(response.data); // Pasar eventos al FullCalendar
                })
                .catch(error => {
                    console.error('Error fetching events:', error);
                    failureCallback(error); // Notificaci'on de falla
                })
        },
        // Agregar evento
        select: function (info) {
            const title = prompt('Ingresar nombre del evento:');
            if (title) {
                const newEvent = {
                    title,
                    start: info.startStr,
                    end: info.endStr,
                };

                // Agregar el evento en el frontend
                calendar.addEvent(newEvent);

                // Guardar el evento en el backend
                axios.post('/api/eventos', newEvent)
                    .then(response => {
                        console.log('Evento guardado:', response.data);
                        alert('Evento creado correctamente.');
                    })
                    .catch(error => {
                        console.error('Error al guardar evento:', error);
                    });
            }
            calendar.unselect(); // Clear the selection
        },
         
        // Arrastrar y soltar eventos
        eventDrop: function (info) {
            const updatedEvent = {
                id: info.event.id,
                start: info.event.start ? info.event.start.toISOString().slice(0, 10)  : null,
                end: info.event.end ? info.event.end.toISOString().slice(0, 10)  : null,
            };

            console.log('Evento soltado exitosamente:', updatedEvent);

            // Enviar los datos al servidor
            axios.put(`/api/eventos/${info.event.id}`, updatedEvent)
                .then(response => {
                    console.log('Evento modificado exitosamente:', response.data);
                    alert('Evento modificado exitosamente!');
                })
                .catch(error => {
                    console.error('Error al actualizar evento:', error);

                    // Revertir el cambio si ocurre un error
                    alert('No se puedo realizar la modificacion. Revertiendo cambios');
                    info.revert();
                });
        },

        // Cambio del tamaño de un evento
        eventResize: function (info) {
            const updatedEvent = {
                id: info.event.id,
                start: info.event.start ? info.event.start.toISOString().slice(0, 10)  : null,
                end: info.event.end ? info.event.end.toISOString().slice(0, 10)  : null,
            };

            // Log the updated event data
            console.log('Redimensionado Evento:', updatedEvent);

            // Send the updated event data to the server
            axios.put(`/api/eventos/${info.event.id}`, updatedEvent)
                .then(response => {
                    console.log('Redimensionado Evento y guardado:', response.data);
                })
                .catch(error => {
                    console.error('Error al actualizar un evento:', error);
                    alert('No se pudo guardar el evento redimensionado. Revertiendo cambios.');

                    // Revertir el evento a su estado original en caso de error
                    info.revert();
                });
        },

         // eventClick para modificar o eliminar un evento
        eventClick: function (info) {
            const action = prompt(`Que desea realizar? Modificar "1" o Eliminar "2"`);
            if (action === '2') {
                // Confirma la eliminación
                if (confirm('Desea eliminar el evento?')) {
                    // Elimina el evento del servidor
                    axios.delete(`/api/eventos/${info.event.id}`)
                        .then(response => {
                            info.event.remove(); // Elimina el evento localmente
                            alert('Evento eliminado correctamente!');
                        })
                        .catch(error => {
                            console.error('Error al eliminar un evento:', error);
                            alert('Falla al eliminar el evento.');
                        });
                }
            } else if (action === '1') {
                // Confirmar antes de editar
                const newTitle = prompt('Ingrese un nuevo nombre de evento:', info.event.title);
                if (newTitle) {
                    const updatedEvent = {
                        id: info.event.id, // Evento ID
                        title: newTitle,
                        start: info.event.start ? info.event.start.toISOString().slice(0, 10) : null,
                        end: info.event.end && info.event.start.toISOString().slice(0, 10) === info.event.end.toISOString().slice(0, 10)
                        ? info.event.start.toISOString().slice(0, 10) // Si fin es igual a inicio, establecer fin = inicio
                        : info.event.end
                            ? info.event.end.toISOString().slice(0, 10)
                            : null,
                    };
                    console.log(updatedEvent);
                    // Actualizar el evento en el frontend
                    info.event.setProp('title', newTitle);

                    // Guardar los cambios en el servidor
                    axios.put(`/api/eventos/${info.event.id}`, updatedEvent)
                        .then(response => {
                            console.log('Evento actualizado:', response.data);
                            alert('Evento actualizado correctamente.');
                        })
                        .catch(error => {
                            console.error('Error al actualizar un evento:', error);
                            alert('Fallo al actualizar un evento.');
                        });
                }
            }
        },

    });
    
    calendar.render();

    // Agrega, actualiza y elimina los eventos a través de Livewire
    Livewire.on('eventAdded', () => {
        calendar.refetchEvents(); 
    });

    Livewire.on('eventUpdated', (event) => {
        calendar.getEventById(event.id).setProp('title', event.title);
        calendar.refetchEvents(); 
    });
    
    Livewire.on('eventDeleted', () => {
        calendar.refetchEvents(); 
    });
});

/*function mostrarModalEventoNuevo(info){
    // generar un objeto {base}

    //obtener la fecha en la que hizo click
    console.log(info);

    // mostrar el modal
    $('#modalAgregarEvento').modal('show')
}*/