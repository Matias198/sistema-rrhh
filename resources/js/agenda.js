import "./bootstrap";
import "../css/app.css";
import "bootstrap";
import "overlayscrollbars/overlayscrollbars.css";
import {
    OverlayScrollbars,
    ScrollbarsHidingPlugin,
    SizeObserverPlugin,
    ClickScrollPlugin,
} from "overlayscrollbars";

document.addEventListener('DOMContentLoaded', function() {
     var calendarEl = document.getElementById('agenda');
     var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'es',
      headerToolbar:{
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listWeek'
      },

     dateClick:function(info){
        $("#evento").modal("show");
     }

    });
    calendar.render();
  });
 