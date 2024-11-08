import "./bootstrap";
import "../css/app.css";
import "bootstrap"; 
import "./../../vendor/power-components/livewire-powergrid/dist/powergrid";
//import './../../vendor/power-components/livewire-powergrid/dist/bootstrap5.css'

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
