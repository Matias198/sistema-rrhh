import "./bootstrap";
import "../css/app.css";
import "bootstrap"; 
import "./../../vendor/power-components/livewire-powergrid/dist/powergrid";
//import './../../vendor/power-components/livewire-powergrid/dist/bootstrap5.css'
// import Dropzone from "dropzone";
// import "dropzone/dist/dropzone.css";

// window.Dropzone = Dropzone;
// window.SlimSelect = SlimSelect;

import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import bootstrapPlugin from "@fullcalendar/bootstrap";
import esLocale from "@fullcalendar/core/locales/es";

//import 'bootstrap/dist/css/bootstrap.css';
import "bootstrap-icons/font/bootstrap-icons.css"; // webpack uses file-loader to handle font files

window.Calendar = Calendar;
window.interactionPlugin = interactionPlugin;
window.dayGridPlugin = dayGridPlugin;
window.timeGridPlugin = timeGridPlugin;
window.listPlugin = listPlugin;
window.bootstrapPlugin = bootstrapPlugin;
window.esLocale = esLocale;

document.addEventListener("DOMContentLoaded", function () { 
    function detectarCambioModoOscuro() {
        
        const body = document.body;
        const darkModeClass = "dark-mode";

        // Función para ejecutar cuando se detecte un cambio
        function modoOscuroCambiado() { 

            // Aquí puedes colocar tu código para ejecutar cuando el modo oscuro cambia
            if (body.classList.contains(darkModeClass)) { 
                var links = $("link");
                for (var i = 0; i < links.length; i++) {
                    if (links[i].href.indexOf("flatpickr.css") !== -1) {
                        links[i].href = links[i].href.replace(
                            "flatpickr",
                            "dark"
                        );
                    }
                }               
                $("thead").addClass("dark-mode");
                $(".flatpickr").css("background-color", "#343a40"); 
            } else { 
                var links = $("link");
                for (var i = 0; i < links.length; i++) {
                    if (links[i].href.indexOf("dark.css") !== -1) {
                        links[i].href = links[i].href.replace(
                            "dark",
                            "flatpickr"
                        );
                    }
                } 
                $("thead").removeClass("dark-mode");
                $(".flatpickr").css("background-color", "#ffff"); 
            }
        }

        modoOscuroCambiado();

        // Observador de mutaciones para detectar cambios en las clases del body
        const observer = new MutationObserver(modoOscuroCambiado);
        observer.observe(body, {
            attributes: true,
            attributeFilter: ["class"],
        });
    }

    // Llamar a la función para iniciar la observación
    detectarCambioModoOscuro();
});
