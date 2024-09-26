import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import bootstrapPlugin from "@fullcalendar/bootstrap";
import esLocale from "@fullcalendar/core/locales/es";

//import 'bootstrap/dist/css/bootstrap.css';
import "bootstrap-icons/font/bootstrap-icons.css"; // webpack uses file-loader to handle font files

document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");

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
        initialDate: "2024-01-01",
        navLinks: true, // can click day/week names to navigate views
        dayMaxEvents: true, // allow "more" link when too many events
        events: [
            {
                title: "Feliz Cumpleaños!",
                start: "2024-06-12",
            },
            {
                title: "Evento largo",
                start: "2024-01-07",
                end: "2024-01-10",
            },
            {
                groupId: 999,
                title: "Evento Concurrente",
                start: "2024-01-01T16:00:00",
            },
            {
                groupId: 999,
                title: "Evento Concurrente",
                start: "2024-01-16T16:00:00",
            },
            {
                title: "Conferencias",
                start: "2024-01-11",
                end: "2024-01-13",
            },
            {
                title: "Meeting",
                start: "2024-01-12T10:30:00",
                end: "2024-01-12T12:30:00",
            },
            {
                title: "Lunch",
                start: "2024-01-12T12:00:00",
            },
            {
                title: "Meeting",
                start: "2024-01-12T14:30:00",
            },
            {
                title: "Cena",
                start: "2024-01-12T20:00:00",
            },
            {
                title: "Fiesta de cumpleaños",
                start: "2024-01-13T07:00:00",
            },
            {
                title: "Evento con enlace",
                url: "http://google.com/",
                start: "2024-01-28",
            },
        ],
    });

    calendar.render();
});
