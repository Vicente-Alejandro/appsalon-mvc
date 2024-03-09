function ocultarAlerta() {
    const alertas = document.querySelectorAll('.alerta.errorlog');

    alertas.forEach(function(alerta) {
        setTimeout(function() {
            alerta.classList.add("ocultar-alerta");
        }, 3000); // Ocultar después de 4 segundos (4000 milisegundos)
        setTimeout(function() {
            alerta.style.display = "none";
        }, 4500); // Ocultar después de 5.5 segundos (5500 milisegundos)
    });
}

function ocultarAlertaC() {
    const alertasC = document.querySelectorAll('.alerta.correctlog');

    alertasC.forEach(function(alerta) {
        setTimeout(function() {
            alerta.classList.add("ocultar-alerta");
        }, 3000); // Ocultar después de 4 segundos (4000 milisegundos)
        setTimeout(function() {
            alerta.style.display = "none";
        }, 4500); // Ocultar después de 5.5 segundos (5500 milisegundos)
    });
}

// Llamar a la función para que se ejecute cuando se cargue la página
document.addEventListener("DOMContentLoaded", function() {
    ocultarAlerta();
    ocultarAlertaC();
});