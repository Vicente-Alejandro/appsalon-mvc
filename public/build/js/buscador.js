document.addEventListener("DOMContentLoaded", function() {
    iniciarAppB();
});

function iniciarAppB() {
    buscarPorFecha();
};

function buscarPorFecha() {
    const fechaInput = document.querySelector("#fecha");
    fechaInput.addEventListener("input", function(evento) {
        const fechaSeleccionada = evento.target.value;
        console.log(fechaSeleccionada);

        window.location = `?fecha=${fechaSeleccionada}`;
    })
};