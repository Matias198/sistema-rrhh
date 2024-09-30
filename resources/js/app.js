import "./bootstrap";
import "../css/app.css";
import "bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    function detectarCambioModoOscuro() {
        const body = document.body;
        const darkModeClass = "dark-mode";

        // Función para ejecutar cuando se detecte un cambio
        function modoOscuroCambiado() {
            // Aquí puedes colocar tu código para ejecutar cuando el modo oscuro cambia
            if (body.classList.contains(darkModeClass)) {
                console.log("Modo oscuro activado");
                var links = $("link");
                for (var i = 0; i < links.length; i++) {
                    if (links[i].href.indexOf("flatpickr.css") !== -1) {
                        links[i].href = links[i].href.replace(
                            "flatpickr",
                            "dark"
                        );
                    }
                }
                $('.flatpickr').css('background-color', '#343a40')
                $(".select2-selection__rendered").css("color", "#ffff");
                $(".select2-selection").addClass("form-control");
            } else {
                console.log("Modo oscuro desactivado");
                var links = $("link");
                for (var i = 0; i < links.length; i++) {
                    if (links[i].href.indexOf("dark.css") !== -1) {
                        links[i].href = links[i].href.replace(
                            "dark",
                            "flatpickr"
                        );
                    }
                }
                $('.flatpickr').css('background-color', '#ffff')
                $(".select2-selection__rendered").css("color", "");
            }
        }

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
